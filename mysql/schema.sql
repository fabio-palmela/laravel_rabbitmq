create database simulacao;

use simulacao;

CREATE TABLE `emprestimo_consignado` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cpf_cooperado` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cnpj_ente_consignante` varchar(14) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `valor_credito` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

create database consignado;

use consignado;

CREATE TABLE `cooperados` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cpf_cooperado` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `ente_consignante` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cnpj_ente_consignante` varchar(14) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `cooperados_ente` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  `cooperadoId` bigint unsigned NOT NULL,
  `enteId` bigint unsigned NOT NULL,
  CONSTRAINT fk_cooperados_ente_cooperados  FOREIGN KEY (cooperadoId) REFERENCES cooperados(id),
  CONSTRAINT fk_cooperados_ente_consignante  FOREIGN KEY (enteId) REFERENCES ente_consignante(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `simulacao_consignado` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cpf_cooperado` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cnpj_ente_consignante` varchar(14) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `valor_credito` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `parcelas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `mes` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cnpj_ente_consignante` varchar(14) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prestacao_mensal` double(8,2) NOT NULL,
  `juros_mensais` double(8,2) NOT NULL,
  `amortizacao` double(8,2) NOT NULL,
  `saldo_devedor` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `simulacaoId` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT fk_simulacao_consignado_parcelas  FOREIGN KEY (simulacaoId) REFERENCES simulacao_consignado(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO consignado.simulacao_consignado(cpf_cooperado, cnpj_ente_consignante, valor_credito)
VALUES('05907569662', '33344433344456', 45);

INSERT INTO consignado.parcelas(cpf_cooperado, cnpj_ente_consignante, valor_credito, simulacaoId)
VALUES('05907569662', '33344433344456', 45, 1);

SELECT sc.*, p.valor_credito AS valor 
  FROM consignado.simulacao_consignado sc 
  LEFT JOIN consignado.parcelas p
    ON sc.id = p.simulacaoId;


margem_cooperado
cpf_cooperado
taxa_juros
prazo
valor_credito
mail_ente_consignante
mail_cooperado