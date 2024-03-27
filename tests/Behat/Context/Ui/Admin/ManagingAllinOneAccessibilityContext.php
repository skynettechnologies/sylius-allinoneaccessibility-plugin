<?php

declare(strict_types=1);

namespace Tests\Skynettechnologies\SyliusAllinOneAccessibilityPlugin\Behat\Context\Ui\Admin;

use Behat\Behat\Context\Context;
use FriendsOfBehat\PageObjectExtension\Page\SymfonyPageInterface;
use Skynettechnologies\SyliusAllinOneAccessibilityPlugin\Entity\AllinOneAccessibilityInterface;
use Sylius\Behat\Service\NotificationCheckerInterface;
use Sylius\Behat\Service\Resolver\CurrentPageResolverInterface;
use Tests\Skynettechnologies\SyliusAllinOneAccessibilityPlugin\Behat\Page\Admin\AllinOneAccessibility\CreatePageInterface;
use Tests\Skynettechnologies\SyliusAllinOneAccessibilityPlugin\Behat\Page\Admin\AllinOneAccessibility\IndexPageInterface;
use Tests\Skynettechnologies\SyliusAllinOneAccessibilityPlugin\Behat\Page\Admin\AllinOneAccessibility\UpdatePageInterface;
use Webmozart\Assert\Assert;

final class ManagingAllinOneAccessibilityContext implements Context
{
    /** @var CurrentPageResolverInterface */
    private $currentPageResolver;

    /** @var NotificationCheckerInterface */
    private $notificationChecker;

    /** @var IndexPageInterface */
    private $indexPage;

    /** @var CreatePageInterface */
    private $createPage;

    /** @var UpdatePageInterface */
    private $updatePage;

    public function __construct(
        CurrentPageResolverInterface $currentPageResolver,
        NotificationCheckerInterface $notificationChecker,
        IndexPageInterface $indexPage,
        CreatePageInterface $createPage,
        UpdatePageInterface $updatePage
    ) {
        $this->currentPageResolver = $currentPageResolver;
        $this->notificationChecker = $notificationChecker;
        $this->indexPage = $indexPage;
        $this->createPage = $createPage;
        $this->updatePage = $updatePage;
    }

    /**
     * @When I go to the allinoneaccessibility page
     * @throws \FriendsOfBehat\PageObjectExtension\Page\UnexpectedPageException
     */
    public function iGoToTheAllinOneAccessibilityPage(): void
    {
        $this->indexPage->open();
    }

    /**
     * @Given I want to add a new allinoneaccessibility
     * @throws \FriendsOfBehat\PageObjectExtension\Page\UnexpectedPageException
     */
    public function iWantToAddNewAllinOneAccessibility(): void
    {
        $this->createPage->open();
    }

    /**
     * @When I fill the code with :allinoneaccessibilityCode
     * @param string $allinoneaccessibilityCode
     * @throws \Behat\Mink\Exception\ElementNotFoundException
     */
    public function iFillTheCodeWith(string $allinoneaccessibilityCode): void
    {
        $this->createPage->fillCode($allinoneaccessibilityCode);
    }

    /**
     * @When I fill the url with :allinoneaccessibilityUrl
     * @When I rename the url with :allinoneaccessibilityUrl
     * @param string $allinoneaccessibilityUrl
     * @throws \Behat\Mink\Exception\ElementNotFoundException
     */
    public function iFillTheUrlWith(string $allinoneaccessibilityUrl): void
    {
        $this->createPage->fillUrl($allinoneaccessibilityUrl);
    }

    /**
     * @When I upload the :file image
     * @param string $allinoneaccessibilityImage
     * @throws \Behat\Mink\Exception\ElementNotFoundException
     */
    public function iUploadTheImage(string $allinoneaccessibilityImage): void
    {
        $this->resolveCurrentPage()->uploadFile($allinoneaccessibilityImage, 'Image');
    }

    /**
     * @When I upload the :file mobile image
     * @param string $allinoneaccessibilityImage
     * @throws \Behat\Mink\Exception\ElementNotFoundException
     */
    public function iUploadTheMobileImage(string $allinoneaccessibilityImage): void
    {
        $this->resolveCurrentPage()->uploadFile($allinoneaccessibilityImage, 'Mobile image');
    }

    /**
     * @When I add it
     * @throws \Behat\Mink\Exception\ElementNotFoundException
     */
    public function iAddIt(): void
    {
        $this->createPage->create();
    }

    /**
     * @Given /^I want to modify the (allinoneaccessibility "([^"]+)")/
     * @param AllinOneAccessibilityInterface $allinoneaccessibility
     * @throws \FriendsOfBehat\PageObjectExtension\Page\UnexpectedPageException
     */
    public function iWantToModifyAllinOneAccessibility(AllinOneAccessibilityInterface $allinoneaccessibility): void
    {
        $this->updatePage->open(['id' => $allinoneaccessibility->getId()]);
    }

    /**
     * @When I save my changes
     */
    public function iSaveMyChanges(): void
    {
        $this->updatePage->saveChanges();
    }

    /**
     * @When I want to browse allinoneaccessibilitys
     * @throws \FriendsOfBehat\PageObjectExtension\Page\UnexpectedPageException
     */
    public function iWantToBrowseAllinOneAccessibilitys(): void
    {
        $this->indexPage->open();
    }

    /**
     * @Then I should see :quantity AllinOneAccessibilitys in the list
     * @param $quantity
     */
    public function iShouldSeeAllinOneAccessibilitysInTheList(int $quantity = 1): void
    {
        Assert::same($this->indexPage->countItems(), (int) $quantity);
    }

    /**
     * @When I delete the allinoneaccessibility :code
     * @param string $code
     */
    public function iDeleteTheAllinOneAccessibility(string $code): void
    {
        $this->indexPage->deleteAllinOneAccessibility($code);
    }

    /**
     * @Then /^the (allinoneaccessibility "([^"]+)") should appear in the admin/
     * @param AllinOneAccessibilityInterface $allinoneaccessibility
     * @throws \FriendsOfBehat\PageObjectExtension\Page\UnexpectedPageException
     */
    public function allinoneaccessibilityShouldAppearInTheAdmin(AllinOneAccessibilityInterface $allinoneaccessibility): void
    {
        $this->indexPage->open();

        Assert::true(
            $this->indexPage->isSingleResourceOnPage(['code' => $allinoneaccessibility->getCode()]),
            sprintf('AllinOneAccessibility %s should exist but it does not', $allinoneaccessibility->getCode())
        );
    }

    /**
     * @Then I should be notified that the form contains invalid fields
     */
    public function iShouldBeNotifiedThatTheFormContainsInvalidFields(): void
    {
        Assert::true($this->resolveCurrentPage()->containsError(),
            sprintf('The form should be notified you that the form contains invalid field but it does not')
        );
    }

    /**
     * @Then I should be notified that there is already an existing allinoneaccessibility with provided code
     */
    public function iShouldBeNotifiedThatThereIsAlreadyAnExistingAllinOneAccessibilityWithCode(): void
    {
        Assert::true($this->resolveCurrentPage()->containsErrorWithMessage(
            'There is an existing allinoneaccessibility with this code.',
            false
        ));
    }

    /**
     * @return IndexPageInterface|CreatePageInterface|UpdatePageInterface|SymfonyPageInterface
     */
    private function resolveCurrentPage(): SymfonyPageInterface
    {
        return $this->currentPageResolver->getCurrentPageWithForm([
            $this->indexPage,
            $this->createPage,
            $this->updatePage
        ]);
    }
}
