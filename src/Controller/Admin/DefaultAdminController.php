<?php

namespace Skynettechnologies\SyliusAllinOneAccessibilityPlugin\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

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
     * @throws \Doctrine\DBAL\Driver\Exception
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     * @throws \Doctrine\DBAL\Exception
     */
    public function adminAction($page, RequestStack $requestStack, Security $security): Response
    {
        $user = $security->getUser();
        if (!$user instanceof UserInterface) {
            return $this->json(['status' => 'error', 'message' => 'No user is logged in.']);
        }

        $request = $requestStack->getCurrentRequest();
        $userLogin = method_exists($user, 'getUsername') ? $user->getUsername() : null;

        if (!$userLogin) {
            return $this->json(['status' => 'error', 'message' => 'User login not found.']);
        }

        // SQL query to fetch user details from the sylius_admin_user table
        $sql = 'SELECT username, email FROM sylius_admin_user WHERE username = :username';
        // Use the connection service to execute the query
        $stmt = $this->connection->executeQuery($sql, ['username' => $userLogin]);
        // Fetch the result (use fetchAssociative to get the first row of the result)
        $userData = $stmt->fetchAssociative();
        if (!$userData) {
            return $this->json(['status' => 'error', 'message' => 'User not found in sylius_admin_user table.']);
        }
        $username = $userData['username'];
        $email = $userData['email'];
        $domain = $requestStack->getCurrentRequest()->getHttpHost();
        $base64Domain = base64_encode($domain); // Base64 encode the domain

        $message = '';
        $aioa_url = 'https://ada.skynettechnologies.us/api/get-autologin-link';
        $response = $this->client->request('POST', $aioa_url, [
            'json' => ['website' => $base64Domain], // Send base64-encoded domain
            'headers' => ['Content-Type' => 'application/json'],
        ]);
        $responseData = $response->toArray();
        $AutologinLink = $responseData;
        if (isset($AutologinLink['status']) && $AutologinLink['status'] == 0) {
            $package_type = "free-widget";
            $arr_details = [
                'name' => $username,
                'email' => $email,
                'company_name' => '',
                'website' => $base64Domain,
                'package_type' => $package_type,
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
            ];
            $addUserDomainUrl = 'https://ada.skynettechnologies.us/api/add-user-domain';
            // Send the second POST request to add the user domain
            $addUserDomainResponse = $this->client->request('POST', $addUserDomainUrl, [
                'json' => $arr_details,
                'headers' => ['Content-Type' => 'application/json'],
            ]);
            $addUserDomainData = $addUserDomainResponse->toArray();
            if (isset($addUserDomainData['status']) && $addUserDomainData['status'] === 0) {
                $message = "User domain added successfully.";
            } else {
                $message = "Failed to add user domain. Response:";
            }

            $autologinUrl = 'https://ada.skynettechnologies.us/api/get-autologin-link';
            $autologinResponse = $this->client->request('POST', $autologinUrl, [
                'json' => ['website' => base64_encode($domain)],
                'headers' => ['Content-Type' => 'application/json'],
            ]);
            $autologinData = $autologinResponse->toArray();
            if (isset($autologinData['status'])) {
                $message = "Generated Autologin Link Successfully.";
            } else {
                $message = "Failed to generate Autologin link:";
            }

            $widgetSettingsUrl = 'https://ada.skynettechnologies.us/api/widget-settings-platform';
            $widgetSettingsResponse = $this->client->request('POST', $widgetSettingsUrl, [
                'json' => ['website_url' => $domain],
                'headers' => ['Content-Type' => 'application/json'],
            ]);
            $widgetSettingsData = $widgetSettingsResponse->toArray();
            $widgetData = $widgetSettingsData;
            if (isset($widgetSettingsData['status'])) {
                $message = "Widget Setting Saved Successfully.";
            } else {
                $message = "Failed to save Widget setting:";
            }
        } else {
            $message = "Failed to generate Autologin link for this domain.";
        }
        // Example: Generating a URL for the route using Symfony's router
        $url = $this->generateUrl('skynettechnologies_sylius_allinoneaccessibility_plugin_admin_allinoneaccessibility_create', ['page' => $page]);
        return $this->render('@SkynettechnologiesSyliusAllinOneAccessibilityPlugin/admin/AllinOneAccessibility/_form.html.twig', [
            'url' => $url,  // Pass the generated URL to the template
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
