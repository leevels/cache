<?php

declare(strict_types=1);

namespace Leevel\Cache;

use Leevel\Server\Pool\IConnection;

/**
 * 缓存接口.
 */
interface ICache extends IConnection
{
    /**
     * 批量设置缓存.
     */
    public function put(array|string $keys, mixed $value = null, ?int $expire = null): void;

    /**
     * 缓存存在读取否则重新设置.
     */
    public function remember(string $name, \Closure $dataGenerator, ?int $expire = null): mixed;

    /**
     * 获取缓存.
     */
    public function get(string $name, mixed $defaults = false): mixed;

    /**
     * 设置缓存.
     */
    public function set(string $name, mixed $data, ?int $expire = null): void;

    /**
     * 清除缓存.
     */
    public function delete(string $name): void;

    /**
     * 缓存是否存在.
     */
    public function has(string $name): bool;

    /**
     * 自增.
     */
    public function increase(string $name, int $step = 1, ?int $expire = null): false|int;

    /**
     * 自减.
     */
    public function decrease(string $name, int $step = 1, ?int $expire = null): false|int;

    /**
     * 获取缓存剩余时间.
     *
     * - 不存在的 key:-2
     * - key 存在，但没有设置剩余生存时间:-1
     * - 有剩余生存时间的 key:剩余时间
     */
    public function ttl(string $name): int;

    /**
     * 关闭.
     */
    public function close(): void;

    /**
     * 设置缓存键值正则.
     */
    public function setKeyRegex(string $keyRegex): void;

    /**
     * 释放当前连接.
     *
     * - 用于归还当前的数据库连接到连接池
     *
     * @todo 加入到各种ide-helper中
     */
    public function releaseConnect(): void;
}
