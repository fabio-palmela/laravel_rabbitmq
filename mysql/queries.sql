delete FROM consignado.simulacao_consignado;

DELETE FROM consignado.parcelas;

select * from consignado.simulacao_consignado;

select * from consignado.parcelas;

select sc.valor_credito, p.prestacao_mensal, p.juros_mensais, p.amortizacao, p.saldo_devedor
  from consignado.parcelas p 
  join consignado.simulacao_consignado sc 
    on sc.id = p.simulacaoId
 where sc.cpf_cooperado = '05907569663' 