<?php

namespace Skynettechnologies\SyliusAllinOneAccessibilityPlugin\Controller\Admin;

use Sylius\Component\Core\Model\AdminUserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\RequestStack;

class DefaultAdminController extends AbstractController
{
    private $client;
    private $connection;
    private RequestStack $requestStack;

    public function __construct(HttpClientInterface $client, Connection $connection,RequestStack $requestStack)
    {
        $this->client = $client;
        $this->connection = $connection;
        $this->requestStack = $requestStack;
    }

    /**
     * @Route("/index/{page}", name="sylius_all_in_one_accessibility_plugin.index.admin", defaults={"page"=1})
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function adminAction($page, RequestStack $requestStack): Response
    {
        $user = $this->getUser();
        $adminName = '';
        $adminEmail = '';

        if ($user instanceof AdminUserInterface) {
            $firstName = $user->getFirstName();
            $lastName  = $user->getLastName();
            $adminName  = trim($firstName . ' ' . $lastName);
            $adminEmail = $user->getEmail();
        }
        $request = $this->requestStack->getCurrentRequest();
        $domain = $request ? $request->getHost() : 'localhost';
        $base64Domain = base64_encode($domain);

        /**
         * Fallback logic
         */
        if (empty($adminName)) {
            $adminName = $domain;
        }

        if (empty($adminEmail)) {
            $cleanDomain = preg_replace('#^www\.#', '', $domain);
            $adminEmail = 'no-reply@' . $cleanDomain;
        }
        
        $message = '';
        $countryCode = '';
        $noRequiredEu = 1;

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => 'https://ipapi.co/json',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
        ]);
        $response = curl_exec($ch);

        if ($response === false) {
            $curlError = curl_error($ch);
            curl_close($ch);
        } else {
            curl_close($ch);
            $data = json_decode($response, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $countryCode = $data['country_code'] ?? '';
                $inEu = $data['in_eu'] ?? false;
                $noRequiredEu = $inEu ? 0 : 1;
            }
        }
        curl_close($ch);
        // Send data to add-user-domain
        $arr_details = [
            'name' => $adminName,
            'email' => $adminEmail,
            'company_name' => '',
            'website' => $base64Domain,
            'package_type' => 'free-widget',
            'start_date' => date('Y-m-d H:i:s'),
            'end_date' => '',
            'price' => '',
            'discount_price' => '0',
            'platform' => 'Sylius',
            'api_key' => '',
            'is_trial_period' => '',
            'is_free_widget' => '1',
            'bill_address' => '',
            'country' => '',
            'state' => '',
            'city' => '',
            'post_code' => '',
            'transaction_id' => '',
            'subscr_id' => '',
            'payment_source' => '',
            'no_required_eu' => $noRequiredEu
        ];
        
      

        $session = $this->requestStack->getSession();

        if (!$session->get('aioa_domain_added')) {
        
            $addUserDomainUrl = 'https://ada.skynettechnologies.us/api/add-user-domain';
        
            try {
                $addUserDomainResponse = $this->client->request('POST', $addUserDomainUrl, [
                    'json' => $arr_details,
                    'headers' => ['Content-Type' => 'application/json'],
                ]);
        
                $statusCode = $addUserDomainResponse->getStatusCode();
        
                if ($statusCode === 200) {
                    $addUserDomainData = $addUserDomainResponse->toArray(false);
                
                    if (isset($addUserDomainData['status']) && $addUserDomainData['status'] === 0) {
                        $message = "User domain added successfully.";
                        $session->set('aioa_domain_added', true);
                    } else {
                        $message = "Failed to add user domain.";
                    }
                }
        
            } catch (\Exception $e) {
                $message = "Error: " . $e->getMessage();
            }
        
            $session->set('aioa_domain_added', true);
        }
        
       
        // Get widget settings
        $widgetSettingsUrl = 'https://ada.skynettechnologies.us/api/widget-settings-update-platform';
        $widgetSettingsResponse = $this->client->request('POST', $widgetSettingsUrl, [
            'json' => ['website_url' => $domain],
            'headers' => ['Content-Type' => 'application/json'],
        ]);
        $widgetData = $widgetSettingsResponse->toArray(false);
        $url = $this->generateUrl('skynettechnologies_sylius_allinoneaccessibility_plugin_admin_allinoneaccessibility_create', ['page' => $page]);
        return $this->render('@SkynettechnologiesSyliusAllinOneAccessibilityPlugin/Admin/AllinOneAccessibility/_form.html.twig', [
            'url' => $url,
            'page' => $page,
            'domain' => $domain,
            'user_name' => $adminName,
            'email' => $adminEmail,
            'message' => $message,
            'id' => $widgetData['id'] ?? '',
            'color' => $widgetData['color'] ?? '#420083',
            'position' => $widgetData['position'] ?? 'bottom_right',
            'icon_type' => $widgetData['icon_type'] ?? 'aioa-icon-type-1',
            'icon_size' => $widgetData['icon_size'] ?? 'aioa-default-icon',
            'is_widget_custom_position' => $widgetData['is_widget_custom_position'] ?? 0,
            'widget_position_left' => $widgetData['widget_position_left'] ?? 0,
            'widget_position_top' => $widgetData['widget_position_top'] ?? 0,
            'widget_position_right' => $widgetData['widget_position_right'] ?? 0,
            'widget_position_bottom' => $widgetData['widget_position_bottom'] ?? 0,
            'widget_size' => $widgetData['widget_size'] ?? 0,
            'is_widget_custom_size' => $widgetData['is_widget_custom_size'] ?? 0,
            'widget_icon_size_custom' => $widgetData['widget_icon_size_custom'] ?? 20,
        ]);
    }
}
