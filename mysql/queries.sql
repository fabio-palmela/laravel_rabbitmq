SELECT * FROM consignado.simulacao_consignado;

SELECT sc.valor_credito, p.prestacao_mensal, p.juros_mensais, p.amortizacao, p.saldo_devedor
  FROM consignado.parcelas p 
  JOIN consignado.simulacao_consignado sc 
    ON sc.id = p.simulacaoId
 WHERE sc.id = (SELECT MAX(id) FROM consignado.simulacao_consignado);