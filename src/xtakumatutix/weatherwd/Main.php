<?php

namespace xtakumatutix\weatherwd;

use pocketmine\plugin\PluginBase;

class Main extends PluginBase
{
    public function onEnable()
    {
        $weather = mt_rand(1, 2);
        $this->getServer()->getPluginManager()->registerEvents(new EventListener($this, $weather), $this);
        switch ($weather) {
            case 1:
                $this->getLogger()->notice("読み込み完了 天候は晴れです - ver." . $this->getDescription()->getVersion());
                break;
            case 2:
                $this->getLogger()->notice("読み込み完了 天候は雨です - ver." . $this->getDescription()->getVersion());
                break;
        }
    }
}