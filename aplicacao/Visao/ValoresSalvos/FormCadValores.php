<!DOCTYPE html>
<?php
$msg = @$_GET['MSG'];
if ($msg != null || $msg != '') {
    echo "<script>alert('$msg')</script>";
}
echo "</div>";
?>

<?php
$medida1 = @$_GET['medida1'];
$medida2 = @$_GET['medida2'];
$medida3 = @$_GET['medida3'];

$quantidade_portas = @$_GET['quantidade_portas'];
$quantidade_gavetas = @$_GET['quantidade_gavetas'];

$valor_chapa = @$_POST['valor_chapa'];
$valor_corredicas = @$_POST['valor_corredicas'];
$valor_dobradica = @$_POST['valor_dobradica'];
$valor_fita = @$_POST['valor_fita'];
$valor_parafuso = @$_POST['valor_parafuso'];
$valor_puxador = @$_POST['valor_puxador'];

$valorTotal = @$_POST['valorTotal'];

require './Modelo/ClassCalculos.php';
$calculadora = new Calculadora;

require './Modelo/DAO/ClassOpcoesClientes.php';
$classClientesDAO = new ClassOpcoesClientes();
$oc = $classClientesDAO->OpcoesClientes();
?>

<html>
    <head>
        <meta charset="UTF-8">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
        <title></title>
    </head>
    <body>
        <form action="" method="get" onsubmit="return validarMedida(document.getElementById('medida1').value) && validarMedida(document.getElementById('medida2').value) && validarMedida(document.getElementById('medida3').value)">
            <div class="conteudo">
                <h1>Formulário para cálculo</h1>
                <hr>
                <div class='formulario'>
                    <div class='campos-formulario'>
                        <label for='medida1'>Altura:</label>
                        <input type='text' id='medida1' name='medida1' pattern='[0-9]+([.][0-9]+)?' title='Digite um número válido.' value='0'>
                    </div>
                    <div class='campos-formulario'>
                        <label for='medida2'>Comprimento:</label>
                        <input type='text' id='medida2' name='medida2' pattern='[0-9]+([.][0-9]+)?' title='Digite um número válido.' value='0'>
                    </div>
                    <div class='campos-formulario'>
                        <label for='medida3'>Profundidade:</label>
                        <input type='text' id='medida3' name='medida3' pattern='[0-9]+([.][0-9]+)?' title='Digite um número válido.' value='0'>
                    </div>
                    <br>
                    <div class='campos-formulario'>
                        <label for='quantidade_portas'>Quantidadade de portas:</label>
                        <input type='number' id='quantidade_portas' name='quantidade_portas' value='0'>
                    </div>
                    <div class='campos-formulario'>
                        <label for='quantidade_gavetas'>Quantidade de gavetas:</label>
                        <input type='number' id='quantidade_gavetas' name='quantidade_gavetas' value='0'>
                    </div>
                    <input type="submit" value="Calcular" id="calcular">
                </div>
            </div>
        </form>

        <div class="conteudo">
            
            <h1>Digite os preços manualmente:</h1>
            <hr>

            <div class="formulario-valores">
                <div class="tabela">
                    <form action="" method="post" onsubmit="return validarMedida(document.getElementsByName('valores').value)">
                    <table>
                        <thead>
                            <tr>
                                <th><h4>Produto</h4></th>
                                <th><h4>Quantidade</h4></th>
                                <th><h4>Preço</p></h4>
                                <th><h4>Valor</p></h4>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <?php
                                echo "<tr>
                                <td><p>Chapas</p></td>";
                                $quantidade_chapas = $calculadora->QuantidadeChapasMDF($medida1, $medida2, $medida3);
                                $valor_chapa = ($quantidade_chapas * (float)$valor_chapa);
                                echo "<td>" . $quantidade_chapas . "</td>
                                <td><input type='number' name='valor_chapa' value='0'></td>
                                <td><p>R$" . $valor_chapa .  "</p></td>
                                </tr>";

                                echo "<tr>
                                <td><p>Parafusos</p></td>";
                                $quantidade_parafusos = $calculadora->QuantidadeParafusos($quantidade_chapas);
                                $valor_parafuso = ($quantidade_parafusos * (float)$valor_parafuso);
                                echo "<td>" . $quantidade_parafusos . "</td>
                                <td><input type='number' name='valor_parafuso' value='0'></td>
                                <td><p>R$" . $valor_parafuso .  "</p></td>
                                </tr>";

                                echo "<tr>
                                <td><p>Dobradiças</p></td>";
                                $quantidade_dobradicas = $calculadora->QuantidadeDobradicas($quantidade_portas);
                                $valor_dobradica = ($quantidade_portas * (float)$valor_dobradica);
                                echo "<td>" . $quantidade_dobradicas . "</td>
                                <td><input type='number' name='valor_dobradica' value='0'></td>
                                <td><p>R$" . $valor_dobradica .  "</p></td>
                                </tr>";

                                echo "<tr>
                                <td><p>Corrediças</p></td>";
                                $quantidade_corredicas = $calculadora->QuantidadeCorredicas($quantidade_gavetas);
                                $valor_corredicas = ($quantidade_gavetas * (float)$valor_corredicas);
                                echo "<td>" . $quantidade_corredicas . "</td>
                                <td><input type='number' name='valor_corredicas' value='0'></td>
                                <td><p>R$" . $valor_corredicas .  "</p></td>
                                </tr>";

                                echo "<tr>
                                <td><p>Puxadores</p></td>";
                                $quantidade_puxadores = $calculadora->QuantidadePuxadores($quantidade_gavetas, $quantidade_portas);
                                $valor_puxador = ($quantidade_puxadores * (float)$valor_puxador);
                                echo "<td>" . $quantidade_puxadores . "</td>
                                <td><input type='number' name='valor_puxadores' value='0'></td>
                                <td><p>R$" . $valor_puxador .  "</p></td>
                                </tr>";

                                echo "<tr>
                                <td><p>Fitas</p></td>";
                                $quantidade_fitas = $calculadora->QuantidadeRoloFitas();
                                $valor_fita = ($quantidade_fitas * (float)$valor_fita);
                                if($quantidade_chapas != 0){
                                    echo "<td>" . $quantidade_fitas . "</td>
                                    <td><input type='number' name='valor_fita' value='0'></td>
                                    <td><p>R$" . $valor_fita .  "</p></td>
                                    </tr>";
                                }
                                else{
                                    echo "<td> 0 </td>
                                    <td><input type='number' name='valor_fita' value='0'></td>
                                    <td><p>R$" . $valor_fita .  "</p></td>
                                    </tr>";
                                }
                                
                            ?>
                        </tbody>

                        <tfoot>
                            <tr>
                                <th colspan="2" id="foot-tabela"><h4>Valor Total</h4></th>
                                <th id="foot-tabela"><h4>Opções</h4></th>
                                <th id="foot-tabela"></th>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <?php
                                    $valorTotal = $valor_chapa + $valor_parafuso + $valor_dobradica + $valor_corredicas + $valor_puxador + $valor_fita;
                                    if ($valorTotal == null){
                                        $valorTotal = 0;
                                    }
                                    echo "<h1>O valor total é de R$ $valorTotal</h1>";
                                    ?>
                                </td>
                                <td colspan="2">
                                    <input type="submit" name="acao" value="Total" id="calcular">
                                    <input type="reset" name="acao" value="Limpar Campos" id="limpar">
                                </td>
                            </tr>
                    </form>
                    <form action="./Controle/ControleValoresSalvos.php?ACAO=cadastrarValor" method="post">
                            <tr>
                                <td></td>
                                <td><input type="hidden" name="valorTotal" value="<?php echo $valorTotal; ?>"></td>
                                <td>
                                    <select id="clientes" name="idCliente" required>
                                        <option>Clientes</option>
                                        <?php
                                        foreach($oc as $cliente){
                                            echo "<option value='" . $cliente['id'] . "'> " . $cliente['nome'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td><input type="submit" name="acao" value="Salvar" id="salvar"></td>
                            </tr>
                    </form>
                        </tfoot>
                    </table>
                    
                </div>
            </div>
        </div>
    </body>
</html>
