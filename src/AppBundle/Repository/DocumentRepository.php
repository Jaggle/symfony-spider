<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Document;
use Doctrine\ORM\EntityRepository;

/**
 * DocumentRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DocumentRepository extends EntityRepository
{
    /**
     * 创建一个文档
     *
     * @param $title
     * @param $jobId
     * @param $spiderId
     * @param $meta
     * @param $link
     * @param $content
     * @param $description
     * @return Document
     */
    public function createDocument($title, $jobId, $spiderId, $meta, $link, $content, $description)
    {
        $document = new Document();
        
        $document->setTitle($title);
        $document->setMeta($meta);
        $document->setDescription($description);
        $document->setContent($content);
        $document->setJobId($jobId);
        $document->setLink($link);
        $document->setSpiderId($spiderId);
        
        $nowDate = new \DateTime();
        
        $document->setUpdateTime($nowDate);
        $document->setCreateTime($nowDate);
        
        $this->getEntityManager()->persist($document);
        $this->getEntityManager()->flush();
        
        return $document;
    }
    
    /**
     * @param $jobId
     * @return mixed
     */
    public function getDocumentByJobId($jobId)
    {
        return $this->createQueryBuilder('p')
            ->select('p')
            ->where('p.jobId = :jobId')->setParameter('jobId', $jobId)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param $link
     * @return mixed
     */
    public function getDocumentByLink($link)
    {
        return $this->createQueryBuilder('p')
            ->select('p')
            ->where('p.link = :link')->setParameter('link', $link)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
