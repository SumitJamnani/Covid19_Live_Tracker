<?php
/**
 * Copyright 2012-2014 Rackspace US, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace OpenCloud\Networking\Resource;

use OpenCloud\Common\Resource\PersistentResource;

/**
 * A security group is a named container for security group rules, each of which is
 * represented by {@see \OpenCloud\Networking\Resource\SecurityGroupRule}.
 *
 * @see http://developer.openstack.org/api-ref-networking-v2.html#security_groups
 *
 * @package OpenCloud\Networking\Resource
 */
class SecurityGroup extends PersistentResource
{
    protected static $url_resource = 'security-groups';
    protected static $json_name = 'security_group';

    protected $id;
    protected $name;
    protected $description;
    protected $securityGroupRules;
    protected $tenantId;
    protected $links;

    protected $aliases = array(
        'security_group_rules' => 'securityGroupRules',
        'tenant_id'            => 'tenantId'
    );

    protected $createKeys = array(
        'name',
        'description'
    );

    /**
     * This method is inherited. The inherited method has protected scope
     * but we are widening the scope to public so this method may be called
     * from other classes such as {@see OpenCloud\Networking\Service}.
     */
    public function createJson()
    {
        return parent::createJson();
    }

    /**
     * {@inheritDoc}
     */
    public function update($params = array())
    {
        return $this->noUpdate();
    }
}
