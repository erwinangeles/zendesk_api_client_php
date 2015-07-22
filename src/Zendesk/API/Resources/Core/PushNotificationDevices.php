<?php

namespace Zendesk\API\Resources\Core;

use Zendesk\API\Exceptions\MissingParametersException;
use Zendesk\API\Resources\ResourceAbstract;

/**
 * The Push Notification Devices class exposes methods seen at
 * https://developer.zendesk.com/rest_api/docs/core/push_notification_devices
 */
class PushNotificationDevices extends ResourceAbstract
{
    const OBJ_NAME_PLURAL = 'push_notification_devices';

    /**
     * Declares routes to be used by this resource.
     */
    protected function setUpRoutes()
    {
        parent::setUpRoutes();

        $this->setRoute('deleteMany', 'push_notification_devices/destroy_many.json');
    }

    /**
     * Unregisters the mobile devices that are receiving push notifications.
     * Specify the devices as an array of mobile device tokens.
     *
     * @param array $params
     *
     * @return mixed
     * @throws MissingParametersException
     * @throws \Zendesk\API\Exceptions\RouteException
     */
    public function deleteMany(array $params = [])
    {
        if (! isset($params['tokens']) || ! is_array($params['tokens'])) {
            throw new MissingParametersException(__METHOD__, ['tokens']);

        }
        $postData = [self::OBJ_NAME_PLURAL => $params['tokens']];

        return $this->client->post($this->getRoute(__FUNCTION__), $postData);
    }
}
