<h1>Configuração do Ambiente</h1>
<p>Antes de rodar a aplicação, você precisa configurar o arquivo .env com suas variáveis de ambiente específicas.</p>
<h2>1. Copie o arquivo .env.example para .env:</h2>
<p>Execute o seguinte comando no terminal para criar uma cópia do arquivo de exemplo:</p>
<code>cp .env.example .env</code>
<p>Esse arquivo contém todas as variáveis de ambiente necessárias para rodar a aplicação. Você deve <strong>editar o arquivo <code>.env</code></strong> com os seus valores.</p>
<h2>2. Gerar a chave da aplicação:</h2>
<p>A chave da aplicação (<code>APP_KEY</code>) é usada para criptografar sessões e outros dados sensíveis. Para gerá-la, execute o seguinte comando:</p>
<code>php artisan key:generate</code>
<h2>3. Configurar o banco de dados:</h2>
<p>No arquivo .env, defina as variáveis do banco de dados de acordo com o seu ambiente:</p>
<code>DB_DATABASE</code>: Nome do banco de dados.
<code>DB_USERNAME</code>: Usuário do banco de dados.
<code>DB_PASSWORD</code>: Senha do banco de dados.
<h2>4. Configurar o e-mail:</h2>
<p>Para que o envio de e-mails funcione, configure as variáveis relacionadas ao e-mail no .env:</p>
<ul>
  <li>
    <code>MAIL_USERNAME</code>: Endereço de e-mail usado para enviar notificações (por exemplo, no-reply@exemplo.com).
  </li>
  <li>
    <code>MAIL_PASSWORD</code>: Senha do SMTP ou senha de aplicativo (se estiver usando Gmail, por exemplo).
  </li>
  <li>
    <code>MAIL_FROM_ADDRESS</code>: Endereço de e-mail que aparecerá como remetente.
  </li>
</ul>
</ul>
