<?php


namespace App\Helpers;


use App\Interfaces\HighlighterPluginInterface;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use IsaEken\PluginSystem\PluginSystem;

class Highlighter
{
    /**
     * @param PluginSystem $pluginSystem
     * @param bool $onlyNames
     * @return Collection
     */
    public static function highlighters(PluginSystem $pluginSystem, bool $onlyNames = false) : Collection
    {
        $cacheKey = "highlighter-plugins-".($onlyNames ?? "" . "onlyNames");

        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        $plugins = collect();
        foreach ($pluginSystem->plugins as $plugin)
        {
            if (!method_exists(get_class($plugin), "getName") || !($plugin instanceof HighlighterPluginInterface)) {
                continue;
            }

            if ($onlyNames) {
                $plugins->put(get_class($plugin), $plugin->getName());
            }
            else {
                $plugins->put(get_class($plugin), $plugin);
            }
        }

        Cache::put($cacheKey, $plugins, Carbon::make("+3 days"));
        return $plugins;
    }

    /**
     * @param string $name
     * @param PluginSystem $pluginSystem
     * @return HighlighterPluginInterface|null
     */
    public static function highlighter(string $name, PluginSystem $pluginSystem) : ?HighlighterPluginInterface
    {
        $highlighters = self::highlighters($pluginSystem);
        $highlighter = null;

        foreach ($highlighters as $class => $item) {
            if ($item->getName() === $name) {
                $highlighter = $item;
            }
        }

        return $highlighter;
    }
}
