<?php
/*
 * Copyright 2015 Chris Schalenborgh <chris@schalenborgh.be>
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

namespace ZalandoPHP\Operations;

/**
 * Categories
 *
 * @see    https://github.com/zalando/shop-api-documentation/wiki/Categories
 * @author Chris Schalenborgh <chris@schalenborgh.be>
 */
class Categories extends AbstractOperation
{
    const TARGET_GROUP_ALL    = 'all';
    const TARGET_GROUP_WOMEN  = 'women';
    const TARGET_GROUP_MEN    = 'men';
    const TARGET_GROUP_KIDS   = 'kids';

    protected $endpoint       = 'categories/{key}';

    public function __construct($key = '')
    {
        $this->endpoint = str_replace('{key}', $key, $this->endpoint);
    }

    /*
     * Specify the target group. Check if valid first
     *
     * @param string $targetGroup
     *
     * @return \ZalandoPHP\Operations\Categories
     */
    public function setTargetGroup($targetGroup)
    {
        $validTargetGroups = array(
            self::TARGET_GROUP_ALL,
            self::TARGET_GROUP_WOMEN,
            self::TARGET_GROUP_MEN,
            self::TARGET_GROUP_KIDS
        );

        if (!in_array($targetGroup, $validTargetGroups)) {
            throw new \InvalidArgumentException(sprintf(
                "Invalid targetGroup '%s' passed. Valid types are: '%s'",
                $targetGroup,
                implode(', ', $validTargetGroups)
            ));
        }

        $this->filter['targetGroup'] = $targetGroup;

        return $this;
    }


    /**
     * Sets the resultpage to a specified value
     * Allows to browse resultsets which have more than one page
     *
     * @param integer $page
     *
     * @return \ZalandoPHP\Operations\Categories
     */
    public function setPage($page)
    {
        if (false === is_numeric($page) || $page < 1) {
            throw new \InvalidArgumentException(
                sprintf(
                    '%s is an invalid page value. It has to be numeric, positive and bigger than 1',
                    $page
                )
            );
        }

        $this->filter['page'] = $page;

        return $this;
    }

    /**
     * Sets the size of te resultset to a specified value
     *
     * @param integer $pageSize
     *
     * @return \ZalandoPHP\Operations\Categories
     */
    public function setPageSize($pageSize)
    {
        if (false === is_numeric($pageSize) || $pageSize < 1 || $pageSize > 200) {
            throw new \InvalidArgumentException(
                sprintf(
                    '%s is an invalid page value. It has to be numeric, positive and between than 1 and 200',
                    $pageSize
                )
            );
        }

        $this->filter['pageSize'] = $pageSize;

        return $this;
    }
}
