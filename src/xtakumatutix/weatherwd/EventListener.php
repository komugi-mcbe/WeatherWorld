<?php

namespace xtakumatutix\weatherwd;

use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\level\Level;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\entity\EntityLevelChangeEvent;
use pocketmine\network\mcpe\protocol\LevelEventPacket;

class EventListener implements Listener
{
    private $Main;

    public function __construct(Main $Main, $weather)
    {
        $this->Main = $Main;
        $this->weather = $weather;
    }

    public function onJoin(PlayerJoinEvent $event)
    {
        $player = $event->getPlayer();
        $level = $player->getLevel()->getFolderName();
        if ($this->weather == 2) {
            $player->sendMessage(' §7 >> §f今日の地球の天気は 雨 です');
            if ($level == "earch") {
                $pk = new LevelEventPacket();
                $pk->position = $player;
                $pk->data = 90000;
                $pk->evid = LevelEventPacket::EVENT_START_RAIN;
                $player->dataPacket($pk);
            } else {
                $pk = new LevelEventPacket();
                $pk->position = $player;
                $pk->data = 90000;
                $pk->evid = LevelEventPacket::EVENT_STOP_RAIN;
                $player->dataPacket($pk);
            }
        }else{
            $player->sendMessage(' §7 >> §f今日の地球の天気は 晴れ です');
        }
    }

    public function onWorldChange(EntityLevelChangeEvent $event)
    {
        $entity = $event->getEntity();
        if ($entity instanceof Player) {
            $level = $entity->getLevel()->getFolderName();
            if ($this->weather == 2) {
                if ($level == "earch") {
                    $pk = new LevelEventPacket();
                    $pk->position = $entity;
                    $pk->data = 90000;
                    $pk->evid = LevelEventPacket::EVENT_STOP_RAIN;
                    $entity->dataPacket($pk);
                } else {
                    $pk = new LevelEventPacket();
                    $pk->position = $entity;
                    $pk->data = 90000;
                    $pk->evid = LevelEventPacket::EVENT_START_RAIN;
                    $entity->dataPacket($pk);
                }
            }
        }
    }
}