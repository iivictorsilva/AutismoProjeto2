<?php
// Conectar ao banco de dados
$host = "localhost";
$user = "root";
$password = "";
$dbname = "autismo_plataforma";

$conn = new mysqli($host, $user, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Variável para mensagens de erro
$erro = "";

// Verificar envio do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $tipo_usuario = $_POST['tipo_usuario'];
    $cpf = isset($_POST['cpf']) ? $_POST['cpf'] : null;
    $matricula = isset($_POST['matricula']) ? $_POST['matricula'] : null;
    $doc_professor = isset($_FILES['doc_professor']) ? $_FILES['doc_professor'] : null;
    $comprovante_matricula = isset($_FILES['comprovante_matricula']) ? $_FILES['comprovante_matricula'] : null;

    // Validação adicional
    // ...

    // Definir $sql como null inicialmente
    $sql = null;

    if (empty($erro)) {
        // Inserir no banco
        $sql = "INSERT INTO usuarios (nome, email, senha, tipo_usuario, cpf, matricula) 
                VALUES ('$nome', '$email', '$senha', '$tipo_usuario', '$cpf', '$matricula')";
    }

    // Executar a query apenas se $sql foi definido
    if ($sql) {
        if ($conn->query($sql) === TRUE) {
            // Exibir a notificação de sucesso usando JavaScript
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const notification = document.getElementById('successNotification');
                        notification.style.display = 'block'; // Exibe a notificação

                        // Animação de entrada
                        notification.style.animation = 'slideDown 0.5s ease-out forwards';

                        // Animação de saída após 6 segundos
                        setTimeout(function() {
                            notification.style.animation = 'fadeOut 0.5s ease-out forwards';
                            setTimeout(function() {
                                notification.style.display = 'none'; // Esconde a notificação após a animação de saída
                            }, 300); // Tempo da animação de fadeOut
                        }, 3000); // 3000 milissegundos = 3 segundos
                    });
                  </script>";
        } else {
            echo "Erro ao cadastrar: " . $conn->error;
        }
    } else {
        echo "Erro de validação: " . $erro;
    }
}

$conn->close();
?>
<!DOCTYPE html>
   <html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <!--=============== REMIXICONS ===============-->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.css">

      <!--=============== CSS ===============-->
      <link rel="stylesheet" href="styleTelaLogin.css">
      
      <title>Responsive login and registration form - Bedimcode</title>
   </head>
   <body>
      <!--=============== LOGIN IMAGE ===============-->
      <svg class="login__blob" viewBox="0 0 566 840" xmlns="http://www.w3.org/2000/svg">
         <mask id="mask0" mask-type="alpha">
            <path d="M342.407 73.6315C388.53 56.4007 394.378 17.3643 391.538 
            0H566V840H0C14.5385 834.991 100.266 804.436 77.2046 707.263C49.6393 
            591.11 115.306 518.927 176.468 488.873C363.385 397.026 156.98 302.824 
            167.945 179.32C173.46 117.209 284.755 95.1699 342.407 73.6315Z"/>
         </mask>
      
         <g mask="url(#mask0)">
            <path d="M342.407 73.6315C388.53 56.4007 394.378 17.3643 391.538 
            0H566V840H0C14.5385 834.991 100.266 804.436 77.2046 707.263C49.6393 
            591.11 115.306 518.927 176.468 488.873C363.385 397.026 156.98 302.824 
            167.945 179.32C173.46 117.209 284.755 95.1699 342.407 73.6315Z"/>
      
            <!-- Insert your image (recommended size: 1000 x 1200) -->
            <image class="login__img" href="img/bg-img.png"/>
         </g>
      </svg>      

      <!--=============== LOGIN ===============-->
      <div class="login container grid" id="loginAccessRegister">
         <!--===== LOGIN ACCESS =====-->
         <div class="login__access">
            <h1 class="login__title">Faça login em sua conta.</h1>
            
            <div class="login__area">
               <form action="login.php" class="login__form" method="POST">
                  <div class="login__content grid">
                     <div class="login__box">
                        <input type="email" id="email" name="email" required placeholder=" " class="login__input">
                        <label for="email" class="login__label">Email</label>
            
                        <i class="ri-mail-fill login__icon"></i>
                     </div>
         
                     <div class="login__box">
                        <input type="password" id="password" name="senha" required placeholder=" " class="login__input">
                        <label for="password" class="login__label">Password</label>
            
                        <i class="ri-eye-off-fill login__icon login__password" id="loginPassword"></i>
                     </div>
                  </div>
         
                  <a href="#" class="login__forgot">Esqueceu sua senha?</a>
         
                  <button type="submit" class="login__button">Login</button>
               </form>
      
               <div class="login__social">
                  <p class="login__social-title">Ou faça login com</p>
      
                  <div class="login__social-links">
                     <a href="#" class="login__social-link">
                        <img src="img/icon-google.svg" alt="image" class="login__social-img">
                     </a>
      
                     <a href="#" class="login__social-link">
                        <img src="img/icon-facebook.svg" alt="image" class="login__social-img">
                     </a>
      
                     <a href="#" class="login__social-link">
                        <img src="img/icon-apple.svg" alt="image" class="login__social-img">
                     </a>
                  </div>
               </div>
      
               <p class="login__switch">
                  Don't have an account? 
                  <button id="loginButtonRegister">Criar uma conta</button>
               </p>
            </div>
         </div>

         <!--===== LOGIN REGISTER =====-->
         <div class="login__register">
            <h1 class="login__title">Crie uma nova conta.</h1>
        
            <div class="login__area">
                <form action="cadastro.php" class="login__form" method="POST">
                    <div class="login__content grid">
                        <div class="login__group grid">
                            <div class="login__box">
                                <input type="text" id="names" name="nome" required placeholder=" " class="login__input">
                                <label for="names" class="login__label">Names</label>
                                <i class="ri-id-card-fill login__icon"></i>
                            </div>
        
                            <div class="login__box">
                                <input type="text" id="surnames" name="surnames" required placeholder=" " class="login__input">
                                <label for="surnames" class="login__label">Surnames</label>
                                <i class="ri-id-card-fill login__icon"></i>
                            </div>
                        </div>
        
                        <div class="login__box">
                            <input type="email" id="emailCreate" name="email" required placeholder=" " class="login__input">
                            <label for="emailCreate" class="login__label">Email</label>
                            <i class="ri-mail-fill login__icon"></i>
                        </div>
        
                        <div class="login__box">
                            <input type="password" id="passwordCreate" name="senha" required placeholder=" " class="login__input">
                            <label for="passwordCreate" class="login__label">Password</label>
                            <i class="ri-eye-off-fill login__icon login__password" id="loginPasswordCreate"></i>
                        </div>
        
                        <!-- Novo campo para selecionar tipo de usuário -->
                        <div class="login__box">
                          
                    <select id="tipo_usuario" class="login__input" name="tipo_usuario" required data-live-search="false" onchange="toggleExtraFields()">
                        <option value="" disabled selected hidden>Escolha o tipo de usuário</option>
                        <option value="aluno">Aluno</option>
                        <option value="professor">Professor</option>
                    </select>
                            <label for="tipo_usuario" class="login__label">Tipo de usuario</label>
                        </div>
                    </div>
        
                    <button type="submit" class="login__button">Criar uma conta</button>
                </form>
        
                <p class="login__switch">
                    Already have an account? 
                    <button id="loginButtonAccess">Log In</button>
                </p>
            </div>
        </div>
      </div>
      
      <!--=============== MAIN JS ===============-->
      <script src="script.js"></script>
      <script>
    function toggleExtraFields() {
        const tipoUsuario = document.getElementById("tipo_usuario").value;

        // Mostrar campo CPF apenas para "professor"
        document.getElementById("cpf-field").style.display = (tipoUsuario === "professor") ? "block" : "none";
        // Mostrar campo Documento Profissional apenas para "professor"
        document.getElementById("doc-professor-field").style.display = (tipoUsuario === "professor") ? "block" : "none";
        // Mostrar campo Matrícula apenas para "aluno"
        document.getElementById("matricula-field").style.display = (tipoUsuario === "aluno") ? "block" : "none";
        // Mostrar campo Comprovante de Matrícula apenas para "aluno"
        document.getElementById("comprovante-matricula-field").style.display = (tipoUsuario === "aluno") ? "block" : "none";
    }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>


    <style>
        /* Estilos para a notificação */
        .notification {
            display: none; /* Esconder a notificação por padrão */
            position: fixed;
            top: -100px; /* Começa fora da tela */
            left: 50%;
            transform: translateX(-50%);
            background-color: #4CAF50; /* Cor de fundo verde */
            color: white; /* Cor do texto */
            padding: 15px 30px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            animation: slideDown 2s ease-out, fadeOut 7s ease-out 7s; /* Animação de entrada e saída */
        }

        @keyframes slideDown {
            from {
                top: -100px; /* Começa fora da tela */
            }
            to {
                top: 20px; /* Posição final */
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1; /* Totalmente visível */
            }
            to {
                opacity: 0; /* Desaparece */
            }
        }
    </style>


 <!-- Conteúdo da página -->
     <!-- Conteúdo da página -->
     <div class="login container grid" id="loginAccessRegister">
        <!-- Formulário de cadastro -->
        <form action="cadastro.php" method="POST">
            <!-- Campos do formulário -->
        </form>
    </div>

    <!-- Notificação de sucesso -->
    <div id="successNotification" class="notification">
        <p>Cadastro realizado com sucesso!</p>
    </div>
  


   </body>
</html>