<?php include __DIR__ . '/../layouts/header.php'; ?>
<h2>Login</h2>
<form id="loginForm" method="POST">
  <div class="form-group">
    <label for="email">Email:</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu email" required>
  </div>
  <div class="form-group">
    <label for="password">Senha:</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Digite sua senha" required>
  </div>
  <button type="submit" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i> Entrar</button>
</form>
<div id="alert" class="mt-3"></div>

<script>
$(document).ready(function(){
  $("#loginForm").on("submit", function(e){
    e.preventDefault();
    $.ajax({
      url: '/users/login',
      type: 'POST',
      data: $(this).serialize(),
      dataType: 'json',
      success: function(response){
        $("#alert").html('<div class="alert alert-success">Login realizado com sucesso!</div>');
        // Caso queira armazenar o token no localStorage:
        // localStorage.setItem('token', response.token);
      },
      error: function(xhr){
        let errorMsg = (xhr.responseJSON && xhr.responseJSON.error) ? xhr.responseJSON.error : "Erro na requisição";
        $("#alert").html('<div class="alert alert-danger">' + errorMsg + '</div>');
      }
    });
  });
});
</script>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
