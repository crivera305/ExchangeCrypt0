<?php

namespace AppBundle\Twig;

use AppBundle\Entity\Coin;
use AppBundle\Utils\UtilityClass;
use Symfony\Component\DependencyInjection\ContainerInterface;

class AppExtension extends \Twig_Extension
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * AggregatorExtension constructor.
     * @param $container
     */
    function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('getCoin24HChangeBySymbol', array($this, 'getCoin24HChangeBySymbol')),
            new \Twig_SimpleFunction('getCoinSymbolsArrayByString', array($this, 'getCoinSymbolsArrayByString')),
            new \Twig_SimpleFunction('getCoinTicker', array($this, 'getCoinTicker')),
            new \Twig_SimpleFunction('getProviderById', array($this, 'getProviderById')),
            new \Twig_SimpleFunction('slugify', array($this, 'slugify')),
        );
    }

    public function getCoin24HChangeBySymbol($symbol)
    {
        /** @var Coin $coin */

        $em = $this->container->get('doctrine.orm.entity_manager');
        $coinRepo =$em->getRepository('AppBundle:Coin');
        $coin = $coinRepo->findOneBySlug($symbol);
        if($coin) {
            return $coin->getPercentChange24h();
        }

    }

    public function getProviderById($providerId)
    {
        $em = $this->container->get('doctrine.orm.entity_manager');
        $providerRepo =$em->getRepository('AppBundle:Provider');
        $provider = $providerRepo->find($providerId);

        return $provider;

    }

    public function getCoinTicker($limit = 20)
    {
        $em = $this->container->get('doctrine.orm.entity_manager');
        $coinRepo =$em->getRepository('AppBundle:Coin');

        return $coinRepo->findBy(array(), array('rank' => 'ASC'),$limit);
    }

    public function getCoinSymbolsArrayByString($linkedCoinSymbols)
    {
        if(strpos($linkedCoinSymbols, ';')  !== false){
            return explode(';', $linkedCoinSymbols);
        }

        return array($linkedCoinSymbols);
    }

    public function slugify($string)
    {
        return UtilityClass::slugify($string);
    }

    public function getName()
    {
        return 'aggregator_extension';
    }

}