<?php

declare(strict_types=1);

namespace Skynettechnologies\SyliusAllinOneAccessibilityPlugin\Twig;

use http\QueryString;
use Rector\CodeQuality\NodeAnalyzer\VariableDimFetchAssignResolver;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method  array
 */
final class AllinOneAccessibilityExtension extends AbstractExtension
{
    private ?string $slider = 'default';  // Default value for slider
    public function __construct()
    {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('all_in_one_accessibility', [$this, 'renderAccessibilityWidget']),
        ];
    }

    public function renderAccessibilityWidget(): string
    {
        $domain = $_SERVER['HTTP_HOST'] ?? '';
        $domainBase64 = base64_encode($domain);
        // Widget settings
        $color   = '#420083';
        $token   = '';
        $position = 'bottom_right';
        $icon_type  = 'aioa-icon-type-1';
        $icon_size  = 'aioa-medium-icon';
        // Call API
        $apiUrl = 'https://ada.skynettechnologies.us/api/add-user-domain';
        $ch = curl_init($apiUrl);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode([
                'website' => $domainBase64
            ]),
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json'
            ],
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
        ]);
        $response = curl_exec($ch);
        curl_close($ch);
        $apiResponse = json_decode($response, true);
        // 0 = EU | 1 = NON-EU
        $noRequiredEu = $apiResponse['website_data']['no_required_eu'] ?? 1;
        if ($noRequiredEu == 0) {
            return "
                <script>
                    setTimeout(function () {
                        var s = document.createElement('script');
                        s.src = 'https://eu.skynettechnologies.com/accessibility/js/all-in-one-accessibility-js-widget-minify.js?colorcode={$color}&token={$token}&position={$position}';
                        s.id = 'aioa-adawidget';
                        s.defer = true;
                        document.body.appendChild(s);
                    }, 3000);
                </script>";
        }else{
            return '<script>
            const scriptTag = document.createElement("script");
            scriptTag.id = "aioa-adawidget";
            scriptTag.src = "https://www.skynettechnologies.com/accessibility/js/all-in-one-accessibility-js-widget-minify.js?colorcode=#&token=&position=";
            document.head.appendChild(scriptTag);
        </script>';
        }
    }
    public function getName(): string
    {
        return 'allinoneaccessibility';
    }

    public function __call(string $name, array $arguments)
    {
        // TODO: Implement @method  array
    }
}
