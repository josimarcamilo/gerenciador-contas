$( ".quitar" ).on('click', function( event ) {
  console.log($(this).data('id'));
  var codigo = $(this).data('id');
  $("input[name='codigo_conta'").val(codigo);
});

$( ".btn-editar" ).on('click', function( event ) {
  console.log($(this).data('conta'));
  var conta = $(this).data('conta');

  $("input[name='acao'").val("editar");

  $("input[name='codigo'").val(conta.id);
  $("input[name='descricao'").val(conta.descricao);
  $("select[name='tipo'").val(conta.tipo);
  $("input[name='valor'").val(conta.valor/100);
  $("input[name='vencimento'").val(conta.vencimento);

  $('#modal-criar-editar').modal('show');

});
