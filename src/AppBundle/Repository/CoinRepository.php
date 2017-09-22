<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Coin;
use AppBundle\Utils\UtilityClass;
use Doctrine\ORM\EntityRepository;

class CoinRepository extends EntityRepository
{
    /**
     * @return \Doctrine\ORM\Query
     */
    public function findAllQuery()
    {
        return $this->getEntityManager()
            ->getRepository('AppBundle:Coin')
            ->createQueryBuilder('c')
            ->orderBy('c.dtCreated', 'DESC')
            ->getQuery();
    }

    /**
     * @param string $symbol
     * @return array
     */
    public function findOneBySlug($symbol)
    {
        return $this->getEntityManager()
            ->getRepository('AppBundle:Provider')
            ->createQueryBuilder('p')
            ->where('p.slug = :symbol')
            ->setParameter('symbol', $symbol)
            ->getQuery()
            ->useQueryCache(true)
            ->useResultCache(true)
            ->getOneOrNullResult();
    }

    /**
     * @param $greaterThanValue
     * @return \Doctrine\ORM\Query
     */
    public function findByRankLessThanQuery($greaterThanValue)
    {
        return $this->getEntityManager()
            ->getRepository('AppBundle:Coin')
            ->createQueryBuilder('c')
            ->where('c.rank < :greaterThanValue')
            ->setParameter('greaterThanValue',$greaterThanValue)
            ->orderBy('c.dtCreated', 'DESC')
            ->getQuery();
    }

    /**
     * @param $greaterThanValue
     * @return array
     */
    public function findByRankLessThan($greaterThanValue)
    {
        return $this->findByRankLessThanQuery($greaterThanValue)->getResult();
    }

    /**
     * @param int $limit
     * @return \Doctrine\ORM\Query
     */
    public function findTopCoinsQuery($limit = 10)
    {
        return $this->getEntityManager()
            ->getRepository('AppBundle:Coin')
            ->createQueryBuilder('c')
            ->orderBy('c.rank', 'ASC')
            ->setMaxResults($limit)
            ->getQuery();
    }


    public function saveCoinList($coinsList)
    {
        if (is_array($coinsList)) {
            $em = $this->getEntityManager();
            $coinRepo = $em->getRepository('AppBundle:Coin');

            foreach ($coinsList as $coinItem) {
                $coin = $coinRepo->findOneByName($coinItem->name);

                if (!$coin) {
                    $coin = new Coin();
                }

                $coin->setName($coinItem->name);
                $coin->setSymbol($coinItem->symbol);
                $coin->setRank($coinItem->rank);
                $coin->setPriceBtc($coinItem->price_btc);
                $coin->setPriceUsd($coinItem->price_usd);
                $coin->setAvailableSupply($coinItem->available_supply);
                $coin->setTotalSupply($coinItem->total_supply);
                $coin->setPercentChange1h($coinItem->percent_change_1h);
                $coin->setPercentChange7d($coinItem->percent_change_7d);
                $coin->setPercentChange24h($coinItem->percent_change_24h);
                $coin->setMarketCap($coinItem->market_cap_usd);
                $coin->setVolume24Hour($coinItem->{'24h_volume_usd'});
                $coin->setSlug(UtilityClass::slugify($coinItem->symbol));

                $em->persist($coin);
            }

            $em->flush();
        }
    }


}