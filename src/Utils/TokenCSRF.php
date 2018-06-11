<?php

namespace Blog\Utils;

/**
 * @author Amélie-Dzovinar Haladjian
 */
class TokenCSRF
{
    /**
     * @throws \Exception
     */
    public static function setToken(): void
    {
        $token = bin2hex(random_bytes(64));

        if (!isset($_SESSION['security'])) {
            $_SESSION['security']['token'] = $token;
            $_SESSION['security']['createdAt'] = new \DateTime();
            $_SESSION['security']['attempts'] = 0;
        }
    }

    /**
     * @throws \Exception
     */
    public static function isValid(string $token): bool
    {
        if (isset($token) && isset($_SESSION['security']['token'])) {
            $createdAt = $_SESSION['security']['createdAt'];
            $expiresAt = $createdAt->add(new \DateInterval('PT10M'));

            if (isset($_SESSION['security']) &&
                (new \DateTime() < $expiresAt) &&
                $_SESSION['security']['token'] === $token
            ) {
                return true;
            }

            $_SESSION['security']['attempts'] += 1;

            if ($_SESSION['security']['attempts'] >= 3) {
                unset($_SESSION['security']);
            }
        }

        return false;
    }
}
