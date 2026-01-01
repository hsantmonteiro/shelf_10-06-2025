@component('mail::message')
# Olá, {{ $loan->usuario->name }}

Lembrete: o seu empréstimo do livro **{{ $loan->livro->nm_livro }}** está previsto para devolução no dia **{{ \Carbon\Carbon::parse($loan->dt_devolucao)->format('d/m/Y') }}**.

Por favor, não se esqueça de devolvê-lo ou solicitar uma renovação.

Obrigado,<br>
{{ config('app.name') }}
@endcomponent