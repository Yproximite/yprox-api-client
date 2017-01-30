<?php
declare(strict_types=1);

namespace Yproximite\Api\Model\Article;

use Yproximite\Api\Model\ModelInterface;
use Yproximite\Api\Model\Site\SiteRoute;
use Yproximite\Api\Model\Inheritance\InheritanceStatuses;

/**
 * Class Article
 */
class Article implements ModelInterface
{
    const STATUS_DRAFT     = 'draft';
    const STATUS_PUBLISHED = 'published';

    /**
     * @var int
     */
    private $id;

    /**
     * @var ArticleTranslation[]
     */
    private $translations;

    /**
     * @var Category[]
     */
    private $categories;

    /**
     * @var ArticleMedia[]
     */
    private $medias;

    /**
     * @var int
     */
    private $mediaLimit;

    /**
     * @var string|null
     */
    private $status;

    /**
     * @var bool
     */
    private $displayPrintButton;

    /**
     * @var bool
     */
    private $displayPrintAddress;

    /**
     * @var bool
     */
    private $withReturnButton;

    /**
     * @var bool
     */
    private $showCreationDate;

    /**
     * @var bool
     */
    private $showImageCaption;

    /**
     * @var bool
     */
    private $autoPlaySlider;

    /**
     * @var SiteRoute[]
     */
    private $routes;

    /**
     * @var bool
     */
    private $shareOnFacebook;

    /**
     * @var int
     */
    private $displayOrder;

    /**
     * @var int|null
     */
    private $dataParentId;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var string
     */
    private $inheritanceStatus;

    /**
     * @return string[]
     */
    public static function getStatuses(): array
    {
        return [
            self::STATUS_DRAFT,
            self::STATUS_PUBLISHED,
        ];
    }

    /**
     * Article constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $translations = array_map(function (array $data) {
            return new ArticleTranslation($data);
        }, $data['translations']);

        $categories = array_map(function (array $data) {
            return new Category($data);
        }, $data['categories']);

        $medias = array_map(function (array $data) {
            return new ArticleMedia($data);
        }, $data['medias']);

        $routes = array_map(function (string $path, string $locale) {
            return new SiteRoute(compact('path', 'locale'));
        }, array_values($data['routes']), array_keys($data['routes']));

        $this->id                  = (int) $data['id'];
        $this->translations        = $translations;
        $this->categories          = $categories;
        $this->medias              = $medias;
        $this->mediaLimit          = (int) $data['media_limit'];
        $this->status              = (string) $data['status'];
        $this->displayPrintButton  = (bool) $data['display_print_button'];
        $this->displayPrintAddress = (bool) $data['display_print_address'];
        $this->withReturnButton    = (bool) $data['with_return_button'];
        $this->showCreationDate    = (bool) $data['show_creation_date'];
        $this->showImageCaption    = (bool) $data['show_image_caption'];
        $this->autoPlaySlider      = (bool) $data['auto_play_slider'];
        $this->routes              = $routes;
        $this->shareOnFacebook     = (bool) $data['share_on_facebook'];
        $this->displayOrder        = (int) $data['display_order'];
        $this->dataParentId        = !empty($data['dataParent']) ? (int) $data['dataParent'] : null;
        $this->createdAt           = new \DateTime($data['createdAt']['date']);
        $this->updatedAt           = new \DateTime($data['updatedAt']['date']);
        $this->inheritanceStatus   = (string) $data['inheritance_status'];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return ArticleTranslation[]
     */
    public function getTranslations(): array
    {
        return $this->translations;
    }

    /**
     * @return Category[]
     */
    public function getCategories(): array
    {
        return $this->categories;
    }

    /**
     * @return ArticleMedia[]
     */
    public function getMedias(): array
    {
        return $this->medias;
    }

    /**
     * @return int
     */
    public function getMediaLimit(): int
    {
        return $this->mediaLimit;
    }

    /**
     * @see Article::getStatuses()
     *
     * @return null|string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return bool
     */
    public function isDisplayPrintButton(): bool
    {
        return $this->displayPrintButton;
    }

    /**
     * @return bool
     */
    public function isDisplayPrintAddress(): bool
    {
        return $this->displayPrintAddress;
    }

    /**
     * @return bool
     */
    public function isWithReturnButton(): bool
    {
        return $this->withReturnButton;
    }

    /**
     * @return bool
     */
    public function isShowCreationDate(): bool
    {
        return $this->showCreationDate;
    }

    /**
     * @return bool
     */
    public function isShowImageCaption(): bool
    {
        return $this->showImageCaption;
    }

    /**
     * @return bool
     */
    public function isAutoPlaySlider(): bool
    {
        return $this->autoPlaySlider;
    }

    /**
     * @return SiteRoute[]
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }

    /**
     * @return bool
     */
    public function isShareOnFacebook(): bool
    {
        return $this->shareOnFacebook;
    }

    /**
     * @return int
     */
    public function getDisplayOrder(): int
    {
        return $this->displayOrder;
    }

    /**
     * @return int|null
     */
    public function getDataParentId()
    {
        return $this->dataParentId;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @see InheritanceStatuses::getValues()
     *
     * @return string
     */
    public function getInheritanceStatus(): string
    {
        return $this->inheritanceStatus;
    }
}
