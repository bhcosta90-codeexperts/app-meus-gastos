<div class="px-4 mx-auto max-w-7xl py-15">

    @include('includes.message')

    <div class="flex flex-wrap mb-6 -mx-3">

        <h2 class="w-full px-3 pb-4 mb-2 border-b-2 border-cool-gray-800">
            Realizar Pagamento Assinatura - Plano Escolhido {{$plan->name}}
        </h2>
    </div>

    <form action="" x-data="creditCard()" x-init="PagSeguroDirectPayment.setSessionId('{{ $sessionId }}')" name="creditCard" class="w-full max-w-4xl mx-auto">

        <div class="flex flex-wrap -mx-3">

            <p class="w-full px-3 mb-6">
                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">Número Cartão</label>
                <input @keyup="getBrand" type="text" name="card_number"
                    class="block w-full px-4 py-3 pr-8 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
            </p>

            <p class="w-full px-3 mb-6">
                <label class="block text-xs font-bold tracking-wide text-gray-700 uppercase mb2">Nome Cartão</label>
                <input type="text" name="card_name"
                    class="block w-full px-4 py-3 pr-8 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
            </p>

        </div>

        <div class="flex -mx-3">

            <p class="w-full px-3 mb-6">
                <label class="block text-xs font-bold tracking-wide text-gray-700 uppercase mb2">Mês Vencimento</label>
                <input type="text" name="card_month"
                    class="block w-full px-4 py-3 pr-8 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
            </p>

            <p class="w-full px-3 mb-6">
                <label class="block text-xs font-bold tracking-wide text-gray-700 uppercase mb2">Ano Vencimento</label>
                <input type="text" name="card_year"
                    class="block w-full px-4 py-3 pr-8 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
            </p>

        </div>

        <div class="flex flex-wrap mb-6 -mx-3">

            <p class="w-full px-3 mb-6">
                <label class="block text-xs font-bold tracking-wide text-gray-700 uppercase mb2">Código de
                    Segurança</label>
                <input type="text" name="card_cvv"
                    class="block w-full px-4 py-3 pr-8 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
            </p>

            <p class="w-full px-3 py-4 mb-6">
                <button @click.prevent="cardToken" type="button"
                    class="flex-shrink-0 px-2 py-1 text-sm text-white bg-teal-500 border-4 border-teal-500 rounded hover:bg-teal-700 hover:border-teal-700">Realizar
                    Assinatura</button>
            </p>

        </div>

    </form>

    <script type="text/javascript"
        src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>

    <script>
        function creditCard() {
            return {
                getBrand(e) {
                    let cardNumber = e.target.value;

                    if (cardNumber.length >= 6) {
                        PagSeguroDirectPayment.getBrand({
                            cardBin: cardNumber,
                            success: (response) => {
                                console.log(response.brand.name)
                                this.brandName = response.brand.name;
                            }
                        });
                    }
                },
                cardToken(e) {
                    const button = e.target;
                    button.disabled = true;
                    button.classList.add('cursor-not-allowed', 'disabled:opacity-25');
                    const textButton = button.textContent;
                    button.textContent = 'Carregando...';

                    const formEl = document.querySelector('form[name=creditCard]');
                    const formData = new FormData(formEl);

                    PagSeguroDirectPayment.createCardToken({
                        cardNumber: formData.get('card_number'),
                        brand: this.brandName,
                        cvv: formData.get('card_cvv'),
                        expirationMonth: formData.get('card_month'),
                        expirationYear: formData.get('card_year'),
                        success: function(response) {
                            const payload = {
                              'token' : response.card.token,
                              'senderHash': PagSeguroDirectPayment.getSenderHash()
                            };

                            console.log(payload);

                            Livewire.on('subscriptionError', result =>  {
                                button.disabled = false;
                                button.classList.remove('cursor-not-allowed');
                                button.textContent = textButton;
                            });

                            Livewire.emit('paymentData', payload);

                            Livewire.on('subscriptionFinished', result =>  {
                                formEl.reset();
                                location.href = '{{route('dashboard')}}';
                            });
                        }
                    });
                }
            };
        }
    </script>
</div>
