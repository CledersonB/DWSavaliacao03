<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Cadastrar Carro</title>

</head>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 col-sm-4">
            <h2>Cadastrar Carro</h2>
            <br>
            <div class="col-md-8 col-sm-8">
                <label for="modelo">Modelo do carro:</label>
                <input type="text" class="form-control" id="modelo" placeholder="Modelo do carro">
                <label for="ano">Ano de Fabricação:</label>
                <input type="text" class="form-control" id="ano" placeholder="Ano de Fabricação">
                <label for="fabricante">Fabricante:</label>
                <input type="text" class="form-control" id="fabricante" placeholder="Fabricante">
                <label for="cor">Cor:</label>
                <select class="form-select" id="cor">
                    <option value=""></option>
                    <option value="Verde">Verde</option>
                    <option value="Preto">Preto</option>
                    <option value="Prata">Prata</option>
                    <option value="Branco">Branco</option>
                    <option value="Vermelho">Vermelho</option>
                    <option value="Azul">Azul</option>
                    <option value="Personalizada">Personalizada</option>
                </select>
                <label for="tipoMotor">Tipo do motor:</label>
                <select class="form-select" id="tipoMotor">
                    <option value=""></option>
                    <option value="Combustao">Combustão</option>
                    <option value="Eletrico">Elétrico</option>
                    <option value="Hibrido">Híbrido</option>
                </select>

                <button class="btn btn-success" id="salvar" style="margin-top: 10px">Salvar</button>
            </div>
            <br>
            <br>
            <h2>Relatórios</h2>
            <div class="col-lg-3 col-md-3">
                <select class="form-select" id="primeiro-select" onchange="carregarSegundoSelect()">
                    <option value="">Selecione uma opção</option>
                    <option value="ano">Ano de fabricação</option>
                    <option value="tipo_motor">Tipo motor</option>
                    <option value="cor">Cor</option>
                </select>
                <br>
                <select class="form-select" id="segundo-select">
                    <!-- Este será populado dinamicamente -->
                </select>

            </div>
            <div class="botao-salvar">
                <button class="btn btn-secondary" id="gerar" style="margin: 10px">Gerar Relatorio</button>
            </div>
        </div>

        <div class="col-md-6 col-sm-6">
            <table border="1" class="table table-bordered table-secondary table-hover" id="tabela">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Modelo</th>
                        <th>Ano</th>
                        <th>Fabricante</th>
                        <th>Cor</th>
                        <th>Tipo Motor</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <span id="edit"></span>
    </div>
</div>

<script>


    load();

    var carros = [];

    document.getElementById('salvar').addEventListener('click', salvar);
    document.getElementById('gerar').addEventListener('click', relatorio);

    function relatorio() {
        let busca = document.getElementById('primeiro-select');
        let relselect = busca.options[busca.selectedIndex];

        let valor1 = document.getElementById('segundo-select');
        let valor2 = valor1.options[valor1.selectedIndex];


        window.open('../backend/relatoriotcpdf.php?rel=' + relselect.value + "&valor=" + valor2.value, '_blank');
    }

    function load() {
        let table = document.getElementById('tabela');
        table.innerHTML = " ";

        fetch('<?= BASE_URL ?>/backend/dados.php?tabela=veiculos')
            .then(
                response => response.json().then(
                    data => {

                        data.forEach(
                            element => {
                                carros.push(element);

                                let linha = table.insertRow();

                                linha.insertCell().innerHTML = element[0];
                                linha.insertCell().innerHTML = element[1];
                                linha.insertCell().innerHTML = element[2];
                                linha.insertCell().innerHTML = element[3];
                                linha.insertCell().innerHTML = element[4];
                                linha.insertCell().innerHTML = element[5];
                                linha.insertCell().innerHTML = '<button class="btn btn-info" onclick="editar(' + element[0] + ')">Editar</button> <button class="btn btn-danger" onclick="deletar(' + element[0] + ')">Excluir</button>';
                            }
                        );
                    }
                )
            ).catch(
                error => console.log(error)
            );
    }

    var carroeditando = null;



    function salvar() {
        let modelo = document.getElementById('modelo');
        let ano = document.getElementById('ano');
        let fabricante = document.getElementById('fabricante');
        let selectCor = document.getElementById('cor');
        let cor = selectCor.options[selectCor.selectedIndex];
        let selectM = document.getElementById('tipoMotor');
        let tipoMotor = selectM.options[selectM.selectedIndex];



        fetch('<?= BASE_URL ?>/backend/salvar.php', {
            method: "POST",
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                "Access-Control-Allow-Origin": "*",
            },
            body: JSON.stringify({
                modelo: modelo.value,
                ano: ano.value,
                fabricante: fabricante.value,
                cor: cor.value,
                tipoMotor: tipoMotor.value,
                id: (carroeditando) ? carroeditando : null

            }),
        })
            .then(
                response => response.text().then(
                    data => {
                        data = JSON.parse(data);
                        if (data.mensagem == 'ok') {
                            load();
                            modelo.value = "";
                            ano.value = "";
                            fabricante.value = "";
                            selectCor.value = 0;
                            selectM.value = 0;
                            carroeditando = null;

                            carros = [];
                        }
                    }
                )
            )
            .catch(
                error => console.log(error)
            );
    }


    function editar(id) {



        let carro = carros.find(element => element[0] == id);

        document.getElementById('modelo').value = carro[1];
        document.getElementById('ano').value = carro[2];
        document.getElementById('fabricante').value = carro[4];
        document.getElementById('cor').value = carro[3];
        document.getElementById('tipoMotor').value = carro[5];

        carroeditando = carro[0];


    }


    function deletar(id) {
        if (confirm('Deseja excluir o Carro?') == true) {
            fetch('<?= BASE_URL ?>/backend/remove.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    "Access-Control-Allow-Origin": "*"
                },
                body: JSON.stringify({
                    id: id
                })
            }).then(
                response => response.text().then(

                    data => {
                        data = JSON.parse(data);
                        if (data.mensagem == 'ok') {
                            load();
                        }
                    }
                )
            ).catch(
                error => console.log(error)
            );
        }
    }

    function carregarSegundoSelect() {
        var primeiroSelect = document.getElementById('primeiro-select');
        var segundoSelect = document.getElementById('segundo-select');

        // Limpar o segundo select
        segundoSelect.innerHTML = '';

        // Obter o valor selecionado no primeiro select
        var opcaoSelecionada = primeiroSelect.value;

        // Verificar qual opção foi selecionada e popular o segundo select de acordo
        if (opcaoSelecionada === 'ano') {
            var option0 = document.createElement('option');
            option0.value = '<=2019';
            option0.text = 'Antes de 2019';
            segundoSelect.appendChild(option0);
            var option1 = document.createElement('option');
            option1.value = '2019';
            option1.text = '2019';
            segundoSelect.appendChild(option1);

            var option2 = document.createElement('option');
            option2.value = '2020';
            option2.text = '2020';
            segundoSelect.appendChild(option2);

            var option3 = document.createElement('option');
            option3.value = '2021';
            option3.text = '2021';
            segundoSelect.appendChild(option3);
            var option4 = document.createElement('option');
            option4.value = '2022';
            option4.text = '2022';
            segundoSelect.appendChild(option4);

            var option5 = document.createElement('option');
            option5.value = '2023';
            option5.text = '2023';
            segundoSelect.appendChild(option5);


        } else if (opcaoSelecionada === 'tipo_motor') {
            // Popular com opções específicas para a opção 2
            var option3 = document.createElement('option');
            option3.value = 'Eletrico';
            option3.text = 'Eletrico';
            segundoSelect.appendChild(option3);
            var option4 = document.createElement('option');
            option4.value = 'Combustao';
            option4.text = 'Combustão';
            segundoSelect.appendChild(option4);
            var option5 = document.createElement('option');
            option5.value = 'Hibrido';
            option5.text = 'Hibrido';
            segundoSelect.appendChild(option5);
        } else if (opcaoSelecionada === 'cor') {
            var option6 = document.createElement('option');
            option6.value = 'Verde';
            option6.text = 'Verde';
            segundoSelect.appendChild(option6);
            var option7 = document.createElement('option');
            option7.value = 'Preto';
            option7.text = 'Preto';
            segundoSelect.appendChild(option7);
            var option8 = document.createElement('option');
            option8.value = 'Prata';
            option8.text = 'Prata';
            segundoSelect.appendChild(option8);
            var option9 = document.createElement('option');
            option9.value = 'Branco';
            option9.text = 'Branco';
            segundoSelect.appendChild(option9);
            var option10 = document.createElement('option');
            option10.value = 'Vermelho';
            option10.text = 'Vermelho';
            segundoSelect.appendChild(option10);
            var option11 = document.createElement('option');
            option11.value = 'Azul';
            option11.text = 'Azul';
            segundoSelect.appendChild(option11);
            var option12 = document.createElement('option');
            option12.value = 'Personalizada';
            option12.text = 'Personalizada';
            segundoSelect.appendChild(option12);
        }
    }



</script>