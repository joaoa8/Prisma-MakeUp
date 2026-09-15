<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar compra</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../styles/styleGeral.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        :root {
            --primary: #F4D6F8;
            --secundary: #F8F3D6;
            --tertiary: #D5F8F2;
            --primary2: #DE97F2;
            --secundary2: #F2DE97;
            --tertiary2: #63d0d9;
        }

        body {
            min-height: 100dvh;
            background: linear-gradient(135deg, var(--primary) 0%, var(--tertiary) 55%, var(--secundary) 100%);
        }

        main {
            padding-top: 150px;
            padding-bottom: 150px;
        }

        .checkout-card {
            width: 100%;
            max-width: 960px;
            background: #fff;
            border-radius: 1rem;
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, .12);
            padding: 2rem;
        }

        .section-title {
            font-size: 1.05rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .thumb {
            width: 56px;
            height: 56px;
            border-radius: .65rem;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .qty-stepper .btn {
            width: 32px;
            height: 32px;
            padding: 0;
            line-height: 1;
        }

        .qty-input {
            width: 48px;
        }

        .remove-item {
            color: #adb5bd;
            padding: .25rem .5rem;
        }

        .remove-item:hover {
            color: #dc3545;
        }

        .summary-box {
            background-color: var(--tertiary);
            border-radius: .75rem;
            padding: 1.25rem;
        }
        .summary-box .total-row {
            font-size: 1.15rem;
            font-weight: 700;
        }

        /* Inputs */
        .form-control:focus,
        .form-select:focus {
            border-color: var(--tertiary2);
            box-shadow: 0 0 0 .25rem rgba(99, 208, 217, .25);
        }

        .payment-option {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
            border: 1px solid #ced4da;
            border-radius: .65rem;
            padding: .75rem;
            font-weight: 500;
            color: #495057;
            cursor: pointer;
            transition: all .15s ease-in-out;
        }

        .btn-checkout {
            background-color: var(--primary2);
            border-color: var(--primary2);
            color: #fff;
        }

        .btn-checkout:hover {
            background-color: #c875ec;
            border-color: #c875ec;
            color: #fff;
        }

        .btn-checkout:disabled {
            background-color: #e0c3ea;
            border-color: #e0c3ea;
        }

        .cep-hint {
            font-size: .8rem;
            color: #6c757d;
        }
    </style>
</head>

<body>
    <?php include '../components/header.php' ?>
    <main class="container d-flex align-items-center justify-content-center">
        <div class="checkout-card mx-auto">
            <h1 class="fs-4 fw-bold mb-4 text-center">Finalizar compra</h1>

            <div class="row g-4">

                <!-- CARRINHO + RESUMO -->
                <div class="col-lg-7">
                    <p class="section-title">Seu carrinho</p>

                    <div id="cartItems">
                        <div class="cart-item py-3 border-bottom" data-price="89.90">
                            <div class="d-flex align-items-center gap-3">
                                <div class="thumb" style="background-color: var(--primary);">
                                    <i class="bi bi-bag fs-4" style="color: var(--primary2);"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <p class="mb-0 fw-semibold">Kit facial</p>
                                    <p class="mb-0 text-secondary small">R$ 89,90 / unidade</p>
                                </div>
                                <button class="btn remove-item" type="button" aria-label="Remover item">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mt-3">
                                <div class="qty-stepper d-flex align-items-center">
                                    <button class="btn btn-sm btn-outline-secondary qty-minus" type="button" aria-label="Diminuir quantidade">−</button>
                                    <input type="number" class="form-control form-control-sm text-center qty-input mx-1" value="1" min="1" aria-label="Quantidade">
                                    <button class="btn btn-sm btn-outline-secondary qty-plus" type="button" aria-label="Aumentar quantidade">+</button>
                                </div>
                                <div class="text-end" style="min-width: 90px;">
                                    <p class="mb-0 fw-semibold line-total">R$ 89,90</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <p id="emptyCartMsg" class="text-secondary text-center py-4 d-none">Seu carrinho está vazio.</p>

                    <div class="summary-box mt-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <span id="subtotal">R$ 0,00</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Frete</span>
                            <span>Grátis</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between total-row">
                            <span>Total</span>
                            <span id="total">R$ 0,00</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <form method="post" id="checkoutForm">
                        <p class="section-title">Dados do destinatário</p>
                        <div class="row g-3 mb-3">
                            <div class="col-12">
                                <label for="fullName" class="form-label">Nome completo</label>
                                <input type="text" class="form-control" id="fullName" name="fullName"
                                    placeholder="Seu nome completo">
                            </div>
                            <div class="col-12">
                                <label for="phone" class="form-label">Telefone</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    placeholder="(00) 00000-0000">
                            </div>
                        </div>

                        <p class="section-title">Endereço de entrega</p>
                        <div class="row g-3 mb-3">
                            <div class="col-md-5">
                                <label for="cep" class="form-label">CEP</label>
                                <input type="text" class="form-control" id="cep" name="cep" placeholder="00000-000"
                                    maxlength="9" inputmode="numeric">
                                <span class="cep-hint" id="cepStatus"></span>
                            </div>
                            <div class="col-md-7">
                                <label for="street" class="form-label">Rua</label>
                                <input type="text" class="form-control" id="street" name="street"
                                    placeholder="Nome da rua">
                            </div>
                            <div class="col-md-4">
                                <label for="number" class="form-label">Número</label>
                                <input type="text" class="form-control" id="number" name="number" placeholder="123">
                            </div>
                            <div class="col-md-8">
                                <label for="complement" class="form-label">Complemento <span
                                        class="text-secondary">(opcional)</span></label>
                                <input type="text" class="form-control" id="complement" name="complement"
                                    placeholder="Apto, bloco, referência...">
                            </div>
                            <div class="col-md-6">
                                <label for="neighborhood" class="form-label">Bairro</label>
                                <input type="text" class="form-control" id="neighborhood" name="neighborhood"
                                    placeholder="Seu bairro">
                            </div>
                            <div class="col-md-4">
                                <label for="city" class="form-label">Cidade</label>
                                <input type="text" class="form-control" id="city" name="city"
                                    placeholder="Sua cidade">
                            </div>
                            <div class="col-md-2">
                                <label for="state" class="form-label">UF</label>
                                <select class="form-select" id="state" name="state">
                                    <option value="" selected disabled></option>
                                    <option>AC</option>
                                    <option>AL</option>
                                    <option>AP</option>
                                    <option>AM</option>
                                    <option>BA</option>
                                    <option>CE</option>
                                    <option>DF</option>
                                    <option>ES</option>
                                    <option>GO</option>
                                    <option>MA</option>
                                    <option>MT</option>
                                    <option>MS</option>
                                    <option>MG</option>
                                    <option>PA</option>
                                    <option>PB</option>
                                    <option>PR</option>
                                    <option>PE</option>
                                    <option>PI</option>
                                    <option>RJ</option>
                                    <option>RN</option>
                                    <option>RS</option>
                                    <option>RO</option>
                                    <option>RR</option>
                                    <option>SC</option>
                                    <option>SP</option>
                                    <option>SE</option>
                                    <option>TO</option>
                                </select>
                            </div>
                        </div>

                        <p class="section-title">Forma de pagamento</p>
                        <div class="row g-2 mb-1">
                            <div class="col-6">
                                <input type="radio" class="btn-check" name="payment" id="payPix" value="pix" checked>
                                <label class="payment-option" for="payPix">
                                    <i class="bi bi-qr-code"></i>
                                    Pix
                                </label>
                            </div>
                            <div class="col-6">
                                <input type="radio" class="btn-check" name="payment" id="payBoleto" value="boleto">
                                <label class="payment-option" for="payBoleto">
                                    <i class="bi bi-bar-chart-steps"></i>
                                    Boleto
                                </label>
                            </div>
                        </div>

                        <p class="payment-info" id="paymentInfoPix">Você receberá o QR Code do Pix após confirmar o
                            pedido. Pagamento aprovado em poucos minutos.</p>
                        <p class="payment-info d-none" id="paymentInfoBoleto">O boleto será gerado após confirmar o
                            pedido, com vencimento em 3 dias úteis.</p>

                        <button type="submit" class="btn btn-checkout w-100 mt-3" id="submitBtn">Finalizar
                            compra</button>
                    </form>
                </div>

            </div>
        </div>
    </main>
    <?php include '../components/footer.php' ?>
    
    <script src="../scripts/scriptGeral.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>