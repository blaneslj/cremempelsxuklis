-- =====================================================================
-- Cremem pels Xuklis — estructura de la base de dades (sense dades)
--
-- Crea la base de dades, la taula de comandes `tsamarretes` i la taula
-- `migrations` de CodeIgniter amb la migració ja marcada com a feta,
-- perquè `php spark migrate` no intenti tornar a crear la taula.
--
-- Ús:   mysql -u root < database/cremempelsxuklis.sql
--
-- Alternativa sense aquest fitxer: crear la base de dades buida i
-- executar `php spark migrate`.
-- =====================================================================

CREATE DATABASE IF NOT EXISTS `cremempelsxuklis`
  CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `cremempelsxuklis`;

-- Usuari de l'aplicació (posa-hi una contrasenya i copia-la al .env,
-- a database.default.password):
-- CREATE USER IF NOT EXISTS 'cremempelsxuklis'@'localhost' IDENTIFIED BY 'CANVIA-AQUESTA-CONTRASENYA';
-- GRANT ALL PRIVILEGES ON `cremempelsxuklis`.* TO 'cremempelsxuklis'@'localhost';
-- FLUSH PRIVILEGES;

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tsamarretes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(150) NOT NULL,
  `email` varchar(254) NOT NULL,
  `telefon` varchar(20) NOT NULL,
  `q_3_4` smallint(5) unsigned NOT NULL DEFAULT 0,
  `q_5_6` smallint(5) unsigned NOT NULL DEFAULT 0,
  `q_7_8` smallint(5) unsigned NOT NULL DEFAULT 0,
  `q_9_11` smallint(5) unsigned NOT NULL DEFAULT 0,
  `q_xs` smallint(5) unsigned NOT NULL DEFAULT 0,
  `q_s` smallint(5) unsigned NOT NULL DEFAULT 0,
  `q_m` smallint(5) unsigned NOT NULL DEFAULT 0,
  `q_l` smallint(5) unsigned NOT NULL DEFAULT 0,
  `q_xl` smallint(5) unsigned NOT NULL DEFAULT 0,
  `q_2xl` smallint(5) unsigned NOT NULL DEFAULT 0,
  `q_3xl` smallint(5) unsigned NOT NULL DEFAULT 0,
  `q_4xl` smallint(5) unsigned NOT NULL DEFAULT 0,
  `total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

-- Migració ja aplicada (fitxer app/Database/Migrations/2026-11-09-180000_CreateTsamarretes.php)
INSERT INTO `migrations` (`version`, `class`, `group`, `namespace`, `time`, `batch`)
VALUES ('2026-11-09-180000', 'App\\Database\\Migrations\\CreateTsamarretes', 'default', 'App', 1794247225, 1);
