<?php

namespace Drupal\slac_core\Services;

use Drupal\Core\Menu\MenuActiveTrailInterface;
use Drupal\Core\Entity\EntityRepositoryInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;

/**
 * A service class containing methods for handling alerts.
 */
class MicrositeUtilities {

    /**
     * The node storage.
     *
     * @var \Drupal\Core\Entity\EntityStorageInterface
     */
    protected $nodeStorage;

    /**
     * The query instance.
     *
     * @var \Drupal\Core\Entity\Query\QueryInterface
     */
    protected $query;

    /**
     * The menu active trail service.
     *
     * @var \Drupal\Core\Menu\MenuActiveTrail
     */
    protected $menuActiveTrail;

    /**
     * The entity repository service.
     *
     * @var \Drupal\Core\Entity\EntityRepository
     */
    protected $entityRepository;

    /**
     * Constructs a new Alerts object.
     *
     * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
     *   The entity type manager service.
     * @param \Drupal\Core\Menu\MenuActiveTrailInterface $menu_active_trail
     *   The menu active trail service.
     * @param \Drupal\Core\Entity\EntityRepositoryInterface $entity_repository
     *   The entity repository service.
     */
    public function __construct(EntityTypeManagerInterface $entity_type_manager, MenuActiveTrailInterface $menu_active_trail, EntityRepositoryInterface $entity_repository) {
        $this->nodeStorage = $entity_type_manager->getStorage('node');
        $this->query = $this->nodeStorage->getQuery();
        $this->menuActiveTrail = $menu_active_trail;
        $this->entityRepository = $entity_repository;
    }

    /**
     * Get all alerts targeting the homepage.
     *
     * @return array
     *   An array of nids for matching alerts.
     */
    public function IsMicrositePage() {
      return FALSE;
    }

}
