<?php

namespace Skynettechnologies\SyliusAllinOneAccessibilityPlugin\Controller\Admin;

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

    public function __construct(HttpClientInterface $client, Connection $connection)
    {
        $this->client = $client;
        $this->connection = $connection;
    }

    /**
     * @Route("/index/{page}", name="sylius_all_in_one_accessibility_plugin.index.admin", defaults={"page"=1})
     */
    public function adminAction($page, RequestStack $requestStack): Response
    {
        $request = $requestStack->getCurrentRequest();
        $domain = $request->getHttpHost();
        $base64Domain = base64_encode($domain);

        $username = "Dear Customer";
        $email = "no-reply@sylius.com";
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
            'name' => $username,
            'email' => $email,
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

        $addUserDomainUrl = 'https://ada.skynettechnologies.us/api/add-user-domain';
        $addUserDomainResponse = $this->client->request('POST', $addUserDomainUrl, [
            'json' => $arr_details,
            'headers' => ['Content-Type' => 'application/json'],
        ]);
        $addUserDomainData = $addUserDomainResponse->toArray();
        if (isset($addUserDomainData['status']) && $addUserDomainData['status'] === 0) {
            $message = "User domain added successfully.";
        } else {
            $message = "Failed to add user domain.";
        }
        // Get widget settings
        $widgetSettingsUrl = 'https://ada.skynettechnologies.us/api/widget-settings-platform';
        $widgetSettingsResponse = $this->client->request('POST', $widgetSettingsUrl, [
            'json' => ['website_url' => $domain],
            'headers' => ['Content-Type' => 'application/json'],
        ]);
        $widgetData = $widgetSettingsResponse->toArray();

        // Optional: final autologin call (can be removed if unnecessary)
        $autologinUrl = 'https://ada.skynettechnologies.us/api/get-autologin-link';
        $autologinResponse = $this->client->request('POST', $autologinUrl, [
            'json' => ['website' => $base64Domain],
            'headers' => ['Content-Type' => 'application/json'],
        ]);
        $autologinData = $autologinResponse->toArray();
        if (isset($autologinData['status'])) {
            $message .= " Autologin Link generated.";
        }
        $url = $this->generateUrl('skynettechnologies_sylius_allinoneaccessibility_plugin_admin_allinoneaccessibility_create', ['page' => $page]);
        return $this->render('@SkynettechnologiesSyliusAllinOneAccessibilityPlugin/admin/AllinOneAccessibility/_form.html.twig', [
            'url' => $url,
            'page' => $page,
            'domain' => $domain,
            'user_name' => $username,
            'email' => $email,
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
