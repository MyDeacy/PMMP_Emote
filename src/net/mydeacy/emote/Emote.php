<?php

namespace net\mydeacy\emote;

use pocketmine\event\Listener;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\network\mcpe\protocol\EmotePacket;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;

class Emote extends PluginBase {

	public function onEnable() {
		$this->getServer()->getPluginManager()->registerEvents(
			new class implements Listener {
				function onReceivePacket(DataPacketReceiveEvent $event) {
					$packet = $event->getPacket();
					if ($packet instanceof EmotePacket) {
						$player = $event->getPlayer();
						$newPacket = EmotePacket::create($player->getId(), $packet->getEmoteId(), 1);
						Server::getInstance()->broadcastPacket($player->getViewers(), $newPacket);
					}
				}
			}, $this);
	}
}