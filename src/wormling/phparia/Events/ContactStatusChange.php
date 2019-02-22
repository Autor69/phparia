<?php
/**
 * Created by PhpStorm.
 * User: Piskle
 * Date: 2019-02-22
 * Time: 13:49
 */

namespace phparia\Events;

use phparia\Client\AriClient;
use phparia\Resources\ContactInfo;
use phparia\Resources\Endpoint;

class ContactStatusChange extends Event implements IdentifiableEventInterface
{
	/**
	 * @var ContactInfo
	 */
	private $contact_info;

	/**
	 * @var Endpoint
	 */
	private $endpoint;

	/**
	 * @return ContactInfo
	 */
	public function getContactInfo()
	{
		return $this->contact_info;
	}

	/**
	 * @return Endpoint
	 */
	public function getEndpoint()
	{
		return $this->endpoint;
	}

	public function getEventId()
	{
		return "{$this->getType()}_{$this->getContactInfo()->getAor()}";
	}

	/**
	 * @param AriClient $client
	 * @param string $response
	 */
	public function __construct(AriClient $client, $response)
	{
		parent::__construct($client, $response);

		$this->endpoint = $this->getResponseValue('endpoint', '\phparia\Resources\Endpoint', $client);
		$this->contact_info = $this->getResponseValue('contact_info', '\phparia\Resources\ContactInfo', $client);
	}
}