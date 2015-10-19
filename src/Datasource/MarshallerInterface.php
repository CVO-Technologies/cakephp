<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         3.1.3
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace Cake\Datasource;

/**
 * Interface describing a entity marshaller
 *
 * @package Cake\Datasource
 */
interface MarshallerInterface
{

    /**
     * Hydrate one entity and its associated data.
     *
     * ### Options:
     *
     * * associated: Associations listed here will be marshalled as well.
     * * fieldList: A whitelist of fields to be assigned to the entity. If not present,
     *   the accessible fields list in the entity will be used.
     * * accessibleFields: A list of fields to allow or deny in entity accessible fields.
     *
     * The above options can be used in each nested `associated` array. In addition to the above
     * options you can also use the `onlyIds` option for HasMany and BelongsToMany associations.
     * When true this option restricts the request data to only be read from `_ids`.
     *
     * ```
     * $result = $marshaller->one($data, [
     *   'associated' => ['Tags' => ['onlyIds' => true]]
     * ]);
     * ```
     *
     * @param array $data The data to hydrate.
     * @param array $options List of options
     * @return \Cake\ORM\Entity
     * @see \Cake\ORM\Table::newEntity()
     */
    public function one(array $data, array $options = []);

    /**
     * Hydrate many entities and their associated data.
     *
     * ### Options:
     *
     * * associated: Associations listed here will be marshalled as well.
     * * fieldList: A whitelist of fields to be assigned to the entity. If not present,
     *   the accessible fields list in the entity will be used.
     * * accessibleFields: A list of fields to allow or deny in entity accessible fields.
     *
     * @param array $data The data to hydrate.
     * @param array $options List of options
     * @return array An array of hydrated records.
     * @see \Cake\ORM\Table::newEntities()
     */
    public function many(array $data, array $options = []);

    /**
     * Merges `$data` into `$entity` and recursively does the same for each one of
     * the association names passed in `$options`. When merging associations, if an
     * entity is not present in the parent entity for a given association, a new one
     * will be created.
     *
     * When merging HasMany or BelongsToMany associations, all the entities in the
     * `$data` array will appear, those that can be matched by primary key will get
     * the data merged, but those that cannot, will be discarded. `ids` option can be used
     * to determine whether the association must use the `_ids` format.
     *
     * ### Options:
     *
     * * associated: Associations listed here will be marshalled as well.
     * * validate: Whether or not to validate data before hydrating the entities. Can
     *   also be set to a string to use a specific validator. Defaults to true/default.
     * * fieldList: A whitelist of fields to be assigned to the entity. If not present
     *   the accessible fields list in the entity will be used.
     * * accessibleFields: A list of fields to allow or deny in entity accessible fields.
     *
     * The above options can be used in each nested `associated` array. In addition to the above
     * options you can also use the `onlyIds` option for HasMany and BelongsToMany associations.
     * When true this option restricts the request data to only be read from `_ids`.
     *
     * ```
     * $result = $marshaller->merge($entity, $data, [
     *   'associated' => ['Tags' => ['onlyIds' => true]]
     * ]);
     * ```
     *
     * @param \Cake\Datasource\EntityInterface $entity the entity that will get the
     * data merged in
     * @param array $data key value list of fields to be merged into the entity
     * @param array $options List of options.
     * @return \Cake\Datasource\EntityInterface
     */
    public function merge(EntityInterface $entity, array $data, array $options = []);

    /**
     * Merges each of the elements from `$data` into each of the entities in `$entities`
     * and recursively does the same for each of the association names passed in
     * `$options`. When merging associations, if an entity is not present in the parent
     * entity for a given association, a new one will be created.
     *
     * Records in `$data` are matched against the entities using the primary key
     * column. Entries in `$entities` that cannot be matched to any record in
     * `$data` will be discarded. Records in `$data` that could not be matched will
     * be marshalled as a new entity.
     *
     * When merging HasMany or BelongsToMany associations, all the entities in the
     * `$data` array will appear, those that can be matched by primary key will get
     * the data merged, but those that cannot, will be discarded.
     *
     * ### Options:
     *
     * - associated: Associations listed here will be marshalled as well.
     * - fieldList: A whitelist of fields to be assigned to the entity. If not present,
     *   the accessible fields list in the entity will be used.
     * - accessibleFields: A list of fields to allow or deny in entity accessible fields.
     *
     * @param array|\Traversable $entities the entities that will get the
     *   data merged in
     * @param array $data list of arrays to be merged into the entities
     * @param array $options List of options.
     * @return array
     */
    public function mergeMany($entities, array $data, array $options = []);
}
