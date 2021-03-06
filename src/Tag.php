<?php
namespace ContactHub;

class Tag
{
    const TAGS_TEMPLATE = ['auto' => [], 'manual' => []];
    /**
     * @param array $customer
     * @param $tag
     * @return array
     */
    public static function add(array $customer, $tag)
    {
        if (self::isWithoutTagsSection($customer)) {
            $customer['tags'] = static::TAGS_TEMPLATE;
        }

        if (is_null($customer['tags']['manual'])) {
            $customer['tags']['manual'] = [];
        }

        if (self::isTagAlreadyPresent($customer, $tag)) {
            $customer['tags']['manual'][] = (string) $tag;
        }

        return $customer;
    }

    /**
     * @param array $customer
     * @param $tag
     * @return array
     */
    public static function remove(array $customer, $tag)
    {
        if (self::isWithoutTagsSection($customer)) {
            return $customer;
        }

        if (is_null($customer['tags']['manual'])) {
            return $customer;
        }

        if(($key = array_search($tag, $customer['tags']['manual'])) !== false) {
            unset($customer['tags']['manual'][$key]);
        }
        return $customer;
    }

    /**
     * @param array $customer
     * @return bool
     */
    private static function isWithoutTagsSection(array $customer)
    {
        return is_null($customer['tags']) || empty($customer['tags']);
    }

    /**
     * @param array $customer
     * @param $tag
     * @return bool
     */
    private static function isTagAlreadyPresent(array $customer, $tag)
    {
        return !in_array($tag, $customer['tags']['manual']);
    }
}