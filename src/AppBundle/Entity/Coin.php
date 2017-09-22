<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Class Provider
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CoinRepository")
 * @ORM\Table(indexes={
 *     @ORM\Index(name="search_idx", columns={"slug"}),
 *     @ORM\Index(name="rank_idx", columns={"rank"}),
 * })
 * @ORM\HasLifecycleCallbacks
 */
class Coin
{
    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function prePostSaveHooks()
    {
        $dateTime = new \DateTime();
        $this->setDtUpdated($dateTime);

        if ($this->getDtCreated() == null) {
            $this->setDtCreated($dateTime);
        }
    }

    /**
     * @var integer
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    public $name;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    public $symbol;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     */
    public $rank;

    /**
     * @var float
     * @ORM\Column(type="float")
     */
    public $priceUsd;

    /**
     * @var float
     * @ORM\Column(type="float")
     */
    public $priceBtc;

    /**
     * @var float
     * @ORM\Column(type="float", nullable=true)
     */
    public $volume24Hour;

    /**
     * @var float
     * @ORM\Column(type="float", nullable=true)
     */
    public $marketCap;

    /**
     * @var float
     * @ORM\Column(type="float", nullable=true)
     */
    public $availableSupply;

    /**
     * @var float
     * @ORM\Column(type="float", nullable=true)
     */
    public $totalSupply;

    /**
     * @var float
     * @ORM\Column(type="float", nullable=true)
     */
    public $percentChange1h;

    /**
     * @var float
     * @ORM\Column(type="float", nullable=true)
     */
    public $percentChange24h;

    /**
     * @var float
     * @ORM\Column(type="float", nullable=true)
     */
    public $percentChange7d;

    /**
     * @var string
     * @ORM\Column(type="string",length=255)
     */
    public $slug;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=false, type="datetime", options={"default": 0})
     */
    protected $dtCreated;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=false)
     */
    protected $dtUpdated;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getSymbol()
    {
        return $this->symbol;
    }

    /**
     * @param string $symbol
     */
    public function setSymbol($symbol)
    {
        $this->symbol = $symbol;
    }

    /**
     * @return int
     */
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * @param int $rank
     */
    public function setRank($rank)
    {
        $this->rank = $rank;
    }

    /**
     * @return float
     */
    public function getPriceUsd()
    {
        return $this->priceUsd;
    }

    /**
     * @param float $priceUsd
     */
    public function setPriceUsd($priceUsd)
    {
        $this->priceUsd = $priceUsd;
    }

    /**
     * @return float
     */
    public function getPriceBtc()
    {
        return $this->priceBtc;
    }

    /**
     * @param float $priceBtc
     */
    public function setPriceBtc($priceBtc)
    {
        $this->priceBtc = $priceBtc;
    }

    /**
     * @return float
     */
    public function getVolume24Hour()
    {
        return $this->volume24Hour;
    }

    /**
     * @param float $volume24Hour
     */
    public function setVolume24Hour($volume24Hour)
    {
        $this->volume24Hour = $volume24Hour;
    }

    /**
     * @return float
     */
    public function getMarketCap()
    {
        return $this->marketCap;
    }

    /**
     * @param float $marketCap
     */
    public function setMarketCap($marketCap)
    {
        $this->marketCap = $marketCap;
    }

    /**
     * @return float
     */
    public function getAvailableSupply()
    {
        return $this->availableSupply;
    }

    /**
     * @param float $availableSupply
     */
    public function setAvailableSupply($availableSupply)
    {
        $this->availableSupply = $availableSupply;
    }

    /**
     * @return float
     */
    public function getTotalSupply()
    {
        return $this->totalSupply;
    }

    /**
     * @param float $totalSupply
     */
    public function setTotalSupply($totalSupply)
    {
        $this->totalSupply = $totalSupply;
    }

    /**
     * @return float
     */
    public function getPercentChange1h()
    {
        return $this->percentChange1h;
    }

    /**
     * @param float $percentChange1h
     */
    public function setPercentChange1h($percentChange1h)
    {
        $this->percentChange1h = $percentChange1h;
    }

    /**
     * @return float
     */
    public function getPercentChange24h()
    {
        return $this->percentChange24h;
    }

    /**
     * @param float $percentChange24h
     */
    public function setPercentChange24h($percentChange24h)
    {
        $this->percentChange24h = $percentChange24h;
    }

    /**
     * @return float
     */
    public function getPercentChange7d()
    {
        return $this->percentChange7d;
    }

    /**
     * @param float $percentChange7d
     */
    public function setPercentChange7d($percentChange7d)
    {
        $this->percentChange7d = $percentChange7d;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return \DateTime
     */
    public function getDtCreated()
    {
        return $this->dtCreated;
    }

    /**
     * @param \DateTime $dtCreated
     */
    public function setDtCreated($dtCreated)
    {
        $this->dtCreated = $dtCreated;
    }

    /**
     * @return \DateTime
     */
    public function getDtUpdated()
    {
        return $this->dtUpdated;
    }

    /**
     * @param \DateTime $dtUpdated
     */
    public function setDtUpdated($dtUpdated)
    {
        $this->dtUpdated = $dtUpdated;
    }

}