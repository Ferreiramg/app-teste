<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Offcanvas</a>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="darkModeToggle">
                <label class="form-check-label" for="darkModeToggle">Dark Mode</label>
            </div>

        </div>
    </nav>

    <div class="container-fluid mt-5 pt-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Início</a></li>
                <li class="breadcrumb-item active" aria-current="page">Clientes</li>
            </ol>
        </nav>
        <hr>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-header d-flex align-items-end justify-content-between">
                            <h5 class="card-title">Card title</h5>
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                data-bs-target="#created-cliente">
                                Novo Cliente
                            </button>
                        </div>
                        <div class="card-body p-0">
                            <table id="table-clientes" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Razão Social</th>
                                        <th scope="col">CPF/CNPJ</th>
                                        <th scope="col">Cidade/UF</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Telefone</th>
                                        <th scope="col" class="text-center">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>

                            </table>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-end">

                            <ul class="pagination">
                                {{-- <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li> --}}
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="created-cliente" tabindex="-1"data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form novalidate>
                    @csrf
                    <input type="hidden" class="reset" name="id">
                    <input type="hidden" class="reset" name="endereco.id">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modal-label">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                    data-bs-target="#home-tab-pane" type="button" role="tab"
                                    aria-controls="home-tab-pane" aria-selected="true">Informações</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                    data-bs-target="#profile-tab-pane" type="button" role="tab"
                                    aria-controls="profile-tab-pane" aria-selected="false">Endereços</button>
                            </li>
                        </ul>
                        <div class="tab-content border-bottom border-start border-end p-3" id="myTabContent">
                            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel"
                                aria-labelledby="home-tab" tabindex="0">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Razão Social: *</label>
                                    <input type="text" class="form-control" name="razao_social" id="name"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="doc" class="form-label">CPF/CNPJ: *</label>
                                    <input type="text" class="form-control" name="cpf_cnpj" id="doc"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email:</label>
                                    <input type="email" class="form-control" name="email" id="email">
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Telefone:</label>
                                    <input type="tel" class="form-control" name="telefone" id="phone">
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel"
                                aria-labelledby="profile-tab" tabindex="1">
                                <div class="mb-3">
                                    <label for="cep" class="form-label">CEP: *</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="cep">
                                        <button onclick="searchCep(event)" class="btn btn-outline-secondary"
                                            type="button" id="button-addon2">🔎</button>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="cidade" class="form-label">Cidade: *</label>
                                    <select class="form-select" name="ibge" id="cidade" required>
                                        <option value="">Selecione uma cidade</option>
                                        @foreach ($cidades as $cidade)
                                            <option value="{{ $cidade->codigo_ibge }}">
                                                {{ $cidade->nome }} / {{ $cidade->uf }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="uf" class="form-label">UF: *</label>
                                    <input type="text" class="form-control" name="uf" id="uf"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Endereço: *</label>
                                    <input type="text" class="form-control" name="logradouro" id="address"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="numero" class="form-label">Numero: *</label>
                                    <input type="text" class="form-control" name="numero" id="numero"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="bairro" class="form-label">Bairro: *</label>
                                    <input type="text" class="form-control" name="bairro" id="bairro"
                                        required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" onclick="handlerSave(event)" class="btn btn-primary">Save
                            changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="toastContainer" class="toast-container position-fixed bottom-0 end-0 p-3">
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="/js/app.js"></script>
    <script>
        const FILTER_CEP = /\d{5}-\d{3}/;

        // const FILTER_CNPJ = /^([0-9]{3}\.?[0-9]{3}\.?[0-9]{3}\-?[0-9]{2}|[0-9]{2}\.?[0-9]{3}\.?[0-9]{3}\/?[0-9]{4}\-?[0-9]{2})$/;

        const state = {
            page: 1,
            data: []
        };
        var _modal = null;

        document.addEventListener('DOMContentLoaded', function() {
            const cepInput = document.getElementById('cep');

            cepInput.addEventListener('input', function() {
                let value = cepInput.value.replace(/\D/g, '');
                if (value.length > 5) {
                    value = value.substring(0, 5) + '-' + value.substring(5, 8);
                }
                cepInput.value = value;
            });

            _modal = new bootstrap.Modal(document.getElementById('created-cliente'));

            document.getElementById('created-cliente').addEventListener('hidden.bs.modal', event => {

                const form = document.querySelector('#created-cliente form');
                form.reset();
                form.querySelectorAll('.reset').forEach(v => v.value = '');
                form.classList.remove('was-validated');

            });

            document.getElementById('darkModeToggle').addEventListener('change', function(event) {
                if (event.target.checked) {
                    document.documentElement.setAttribute('data-bs-theme', 'dark');
                } else {
                    document.documentElement.removeAttribute('data-bs-theme');
                }
            });
            
            //init request
            handlerGetData();

        });

        const handlerGetData = async (page = 1) => {

            state.page = page;

            const url = `/clientes?page=${page}`;

            const tbody = document.querySelector('#table-clientes tbody');

            //loading
            tbody.innerHTML =
                '<tr><td colspan="7" class="text-center"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></td></tr>';

            const response = await fetch(url);

            const data = await response.json();

            if (data) {

                tbody.innerHTML = '';

                state.data = data.data;

                data.data.map(v => {

                    let endereco = v.enderecos.length > 0 ? v.enderecos[0] : {
                        logradouro: '',
                        numero: '',
                        bairro: '',
                        city: '',
                        state: ''
                    };
                    v.telefone = v.telefone ? v.telefone.replace(/(\d{2})(\d{4,5})(\d{4})/, '($1) $2-$3') :
                        '';
                    v.email = v.email ? v.email : '';
                    v.cidade = endereco.city ? `${endereco.city} / ${endereco.state}` : '';
                    return v;
                }).forEach((cliente, index) => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <th scope="row">${cliente.id}</th>
                        <td width="35%">${cliente.razao_social}</td>
                        <td>${cliente.cpf_cnpj}</td>
                        <td>${cliente.cidade}</td>
                        <td>${cliente.email}</td>
                        <td>${cliente.telefone}</td>
                        <td class="text-center" width="145">
                            <button class="btn btn-sm btn-primary" onclick="handlerEdit(event)" data-id="${cliente.id}">Editar</button>
                            <button class="btn btn-sm btn-danger" onclick="handlerDelete(event)" data-id="${cliente.id}">Excluir</button>
                        </td>
                    `;
                    tbody.appendChild(tr);
                });
                //Pagination generator
                Pagination.container = document.querySelector('.pagination');

                Pagination.handlerClick = async (e) => {
                    e.preventDefault();
                    const _page = e.target.dataset.page;
                    await handlerGetData(_page);
                };

                Pagination.linkRender(data);
            }
        };

        const handlerEdit = (event) => {
            event.preventDefault();

            const form = document.querySelector('#created-cliente form');

            const selected_data = state.data.find(v => v.id == event.target.dataset.id);

            const {
                id,
                razao_social,
                cpf_cnpj,
                email,
                telefone,
                enderecos
            } = selected_data;

            const _endereco = enderecos.length > 0 ? enderecos[0] : {
                logradouro: '',
                numero: '',
                bairro: '',
                cidade: {
                    cep: '',
                    uf: '',
                    codigo_ibge: ''
                }
            };

            form.querySelector('input[name="id"]').value = id;
            form.querySelector('input[name="razao_social"]').value = razao_social;
            form.querySelector('input[name="cpf_cnpj"]').value = cpf_cnpj;
            form.querySelector('input[name="email"]').value = email;
            form.querySelector('input[name="telefone"]').value = telefone;
            form.querySelector('input[name="endereco.id"]').value = _endereco.id;
            form.querySelector('input[name="logradouro"]').value = _endereco.logradouro;
            form.querySelector('input[name="numero"]').value = _endereco.numero;
            form.querySelector('input[name="bairro"]').value = _endereco.bairro;
            form.querySelector('input[name="uf"]').value = _endereco.cidade.uf;
            form.querySelector('select[name="ibge"]').value = _endereco.cidade.codigo_ibge;

            _modal.show();
        };

        const handlerDelete = async (event) => {
            event.preventDefault();
            const id = event.target.dataset.id;
            const url = `/clientes/${id}`;

            if (!confirm('Deseja realmente excluir este cliente?')) return;

            const response = await fetch(url, {
                method: 'DELETE',
                headers: {
                    "X-CSRF-TOKEN": document.querySelector(`[name="_token"]`).value,
                    "X-Requested-With": "XMLHttpRequest",
                },
            });

            if (response.errors) {
                showToast('Erro ao excluir cliente!', 'danger');
            } else {
                showToast('Cliente excluido com sucesso!', 'success');
                handlerGetData(state.page);
            }
        };

        const handlerSave = async (event) => {
            event.preventDefault();
            const form = event.target.closest('form');

            const loader = event.target.loader();

            const url = '/clientes';

            if (formValidate(event, form)) {
                loader.show();
                try {
                    const response = await requestPost(url, new FormData(form), form);
                    if (response.errors) {
                        throw new ServeSideError(response.errors);
                    }
                    handlerGetData(state.page);
                    showToast('Cliente salvo com sucesso!', 'success');
                    _modal.hide();

                } catch (error) {
                    if (error instanceof ServeSideError) {
                        handlerFormValidateServerSide(form, error);
                        showInvalidTab(form);
                    } else {
                        //console.log(error);
                        showToast('Erro inesperado, conate o suporte!', 'danger');
                    }
                } finally {
                    loader.hide();
                }
            } else
                showInvalidTab(form);
        };

        const searchCep = async (event) => {
            event.preventDefault();

            const loader = event.target.loader();

            loader.show('');

            const response = await getCEP(event);

            if (response) {
                const form = event.target.closest('form');
                const {
                    logradouro,
                    bairro,
                    ibge,
                    uf
                } = response;

                form.querySelector('#address').value = logradouro;
                form.querySelector('#bairro').value = bairro;
                form.querySelector('#cidade').value = ibge;
                form.querySelector('#uf').value = uf;
                loader.hide();
            }
        };
    </script>
</body>

</html>
