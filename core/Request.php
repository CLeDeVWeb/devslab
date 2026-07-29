<?php

declare(strict_types=1);

namespace DevLab\Http;

/**
 * ============================================================================
 * DevLab Framework
 * ----------------------------------------------------------------------------
 * Représente une requête HTTP.
 * ============================================================================
 */
final readonly class Request
{
	/*==========================================================================
	* Propriétés
	*==========================================================================*/

	private array $query;

	private array $post;

	private array $files;

	private array $cookies;

	private array $server;

	/*==========================================================================
	* Constructeur
	*==========================================================================*/

	public function __construct(
		array $query,
		array $post,
		array $files,
		array $cookies,
		array $server
	) {
		$this->query   = $query;
		$this->post    = $post;
		$this->files   = $files;
		$this->cookies = $cookies;
		$this->server  = $server;
	}

	/*==========================================================================
	* Factory
	*==========================================================================*/

	public static function createFromGlobals(): self
	{
		return new self(
			$_GET,
			$_POST,
			$_FILES,
			$_COOKIE,
			$_SERVER
		);
	}

	/*==========================================================================
	* API publique
	*==========================================================================*/

	public function getMethod(): string
	{
		return strtoupper(
			$this->server['REQUEST_METHOD'] ?? 'GET'
		);
	}

	public function getUri(): string
	{
		return $this->server['REQUEST_URI'] ?? '/';
	}

	public function getPath(): string
	{
		return parse_url(
			$this->getUri(),
			PHP_URL_PATH
		) ?? '/';
	}

	public function getQuery(string $key, mixed $default = null): mixed
	{
		return $this->query[$key] ?? $default;
	}

	public function getPost(string $key, mixed $default = null): mixed
	{
		return $this->post[$key] ?? $default;
	}

	public function hasQuery(string $key): bool
	{
		return array_key_exists($key, $this->query);
	}

	public function hasPost(string $key): bool
	{
		return array_key_exists($key, $this->post);
	}

	public function getServer(string $key, mixed $default = null): mixed
	{
		return $this->server[$key] ?? $default;
	}

	public function getCookie(string $key, mixed $default = null): mixed
	{
		return $this->cookies[$key] ?? $default;
	}

	public function getFile(string $key): ?array
	{
		return $this->files[$key] ?? null;
	}
}