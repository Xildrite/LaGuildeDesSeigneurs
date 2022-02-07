<?php

namespace App\Service;

use DateTime;
use App\Entity\Character;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CharacterRepository;

class CharacterService implements CharacterServiceInterface{
    private $em;
    private $characterRepository;

    public function __construct(CharacterRepository $characterRepository,EntityManagerInterface $em)
    {
        $this->characterRepository = $characterRepository;
        $this->em = $em;
        
    }

    /**
     * (@inheritdoc)
     */
    public function getAll(){
        $charactersFinal = array();
        $characters = $this->characterRepository->findAll();
        foreach($characters as $character) {
            $charactersFinal[] = $character->toArray();
        }
        return $charactersFinal;
    }
    
    public function create(){
        $character = new Character();
        $character
            ->setKind("Il")
            ->setName("Simon Parrot")
            ->setSurname("Le premier de promo")
            ->setCaste("Humour")
            ->setKnowledge("Bibliothèque")
            ->setIntelligence(120)
            ->setLife(7)
            ->setImage("/images/pikachu.jpeg")
            ->setCreation(new \DateTime())
            ->setIdentifier(hash("sha1",uniqid()));

            $this->em->persist($character);
            $this->em->flush();
    return $character;
    }
}
?>