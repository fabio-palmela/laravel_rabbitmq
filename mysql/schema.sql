create database simulacao;

use simulacao;

CREATE TABLE `emprestimo_consignado` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cpf_cooperado` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cnpj_ente_consignante` varchar(14) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `valor_credito` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `simulacao_consignado_cpf_cooperado_unique` (`cpf_cooperado`),
  UNIQUE KEY `simulacao_consignado_cnpj_ente_consignante_unique` (`cnpj_ente_consignante`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

create database consignado;

use consignado;

CREATE TABLE `emprestimo_consignado` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cpf_cooperado` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cnpj_ente_consignante` varchar(14) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `valor_credito` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `simulacao_consignado_cpf_cooperado_unique` (`cpf_cooperado`),
  UNIQUE KEY `simulacao_consignado_cnpj_ente_consignante_unique` (`cnpj_ente_consignante`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;