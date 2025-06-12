<?php
session_start();
if (!isset($_SESSION['user_nome'])) {
    header("Location: ../login_cadastro/login.php");
    exit();
}
$nome = $_SESSION['user_nome'];
$inicial = strtoupper(mb_substr($nome, 0, 1, 'UTF-8'));
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consumo Consciente</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="/assets/favicon/site.webmanifest">
    <link rel="stylesheet" href="/pos_login/pos.css">
</head>
<body class="bg-gray-50">
    <header class="sticky top-0 z-10 bg-white shadow-sm">
        <div class="container mx-auto px-4 py-3 flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <div class="w-10 h-10 rounded-full flex items-center justify-center">
                    <img src="/dev-site/assets/img/logo.png" alt="logo">
                </div>
                <h1 class="text-xl font-semibold text-gray-800">Consumo Consciente</h1>
            </div>
            <!-- Botão hambúrguer para mobile -->
            <button id="menu-btn" class="md:hidden flex items-center px-3 py-2 border rounded text-gray-700 border-gray-400 focus:outline-none" aria-label="Abrir menu">
                <i class="fas fa-bars text-xl"></i>
            </button>
            <!-- Menu desktop -->
            <div class="hidden md:flex items-center space-x-4">
                <div class="profile-icon w-10 h-10 rounded-full border-2 border-solid flex items-center justify-center font-semibold">
                    <?php echo $inicial; ?>
                </div>
                <span class="font-medium text-gray-700">Olá, <?php echo htmlspecialchars($nome); ?>!</span>
                <a href="../pos_login/editarPerfil/editar_perfil.html" class="ml-4 px-4 py-2 bg-white-500 text-black border-2 border-solid rounded transition">Editar Perfil</a>
                <a href="../login_cadastro/logout.php" class="ml-4 px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition">Sair</a>
            </div>
        </div>
        <!-- Menu lateral mobile -->
        <div id="mobile-menu" class="fixed inset-0 bg-black bg-opacity-40 z-50 hidden">
            <div class="absolute top-0 right-0 w-64 bg-white h-full shadow-lg flex flex-col p-6">
                <button id="close-menu" class="self-end mb-6 text-gray-700 text-2xl focus:outline-none" aria-label="Fechar menu">
                    <i class="fas fa-times"></i>
                </button>
                <div class="flex items-center space-x-3 mb-6">
                    <div class="profile-icon w-10 h-10 rounded-full border-2 border-solid flex items-center justify-center font-semibold">
                        <?php echo $inicial; ?>
                    </div>
                    <span class="font-medium text-gray-700">Olá, <?php echo htmlspecialchars($nome); ?>!</span>
                </div>
                <a href="../pos_login/editarPerfil/editar_perfil.html" class="mb-3 px-4 py-2 bg-white-500 text-black border-2 border-solid rounded transition">Editar Perfil</a>
                <a href="../login_cadastro/logout.php" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition">Sair</a>
            </div>
        </div>
    </header>
    <main class="container mx-auto px-4 py-8">
        <section class="mb-12">
            <div class="bg-gradient-to-r from-green-50 to-blue-50 rounded-xl p-8 shadow-sm">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Bem-vindo ao Consumo Consciente!</h2>
                <p class="text-lg text-gray-600 max-w-3xl">
                    Planeje, economize e consuma de forma inteligente. Transforme sua rotina de compras com ferramentas sustentáveis e personalizadas.
                </p>
            </div>
        </section>
        <section class="mb-12">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6 section-title">🛒 Preços nos Mercados</h2>
            <p class="text-gray-600 mb-6">
                Confira os preços dos produtos em diferentes mercados para fazer escolhas mais econômicas e conscientes.
            </p>
            <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700">Mercado</th>
                                <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700">Produto</th>
                                <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700">Preço (R$)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $servername = "localhost";
                            $username = "root"; 
                            $password = ""; 
                            $dbname = "projeto"; 

                            try {
                                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                
                                $stmt = $conn->prepare("SELECT mercado_nome, produto, preco FROM mercados_precos ORDER BY mercado_nome, produto");
                                $stmt->execute();
                                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                if (count($result) > 0) {
                                    foreach ($result as $row) {
                                        echo "<tr class='border-b border-gray-200'>";
                                        echo "<td class='py-3 px-4 text-sm text-gray-600'>" . htmlspecialchars($row['mercado_nome']) . "</td>";
                                        echo "<td class='py-3 px-4 text-sm text-gray-600'>" . htmlspecialchars($row['produto']) . "</td>";
                                        echo "<td class='py-3 px-4 text-sm text-gray-600'>" . number_format($row['preco'], 2, ',', '.') . "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='3' class='py-3 px-4 text-sm text-gray-600 text-center'>Nenhum dado encontrado.</td></tr>";
                                }
                            } catch (PDOException $e) {
                                echo "<tr><td colspan='3' class='py-3 px-4 text-sm text-red-600 text-center'>Erro ao conectar ao banco de dados: " . $e->getMessage() . "</td></tr>";
                            }
                            $conn = null;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
                <section class="mb-12">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6 section-title">🧠 Sugestões Inteligentes para Você</h2>
                    <p class="text-gray-600 mb-6">
                        Receba recomendações personalizadas com base no seu histórico de consumo, localização, preferências alimentares e promoções atuais.
                    </p>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                            <h3 class="font-medium text-gray-800 mb-2">Trocas sustentáveis</h3>
                            <p class="text-gray-600 text-sm mb-2">Substitua o sabão líquido por sabão em barra natural</p>
                            <div class="flex items-center text-xs text-green-600">
                                <i class="fas fa-check-circle mr-1"></i>
                                <span>Redução de 75% na pegada de carbono</span>
                            </div>
                            <div class="mt-3 flex justify-between items-center">
                                <span class="text-xs text-gray-500">Economia estimada: R$ 120/ano</span>
                            </div>
                        </div>
                        </div>
                    </div>
                </section>
        <section class="mb-12">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6 section-title">🥗 Receitas Sustentáveis</h2>
            <p class="text-gray-600 mb-6">
                Receitas saudáveis, sustentáveis e fáceis de preparar, com ingredientes acessíveis e de baixo impacto ambiental.
            </p>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <div class="recipe-card bg-white rounded-xl overflow-hidden shadow-sm transition-all duration-300">
                    <div class="h-40 bg-green-100 flex items-center justify-center">
                        <i class="fas fa-utensils text-4xl text-green-600"></i>
                    </div>
                    <div class="p-4">
                        <h3 class="font-medium text-gray-800 mb-2">Bolinho de Arroz Reaproveitado</h3>
                        <p class="text-gray-600 text-sm mb-3">Transforme sobras de arroz em deliciosos bolinhos crocantes</p>
                        <div class="flex justify-between items-center mb-3">
                            <div class="flex items-center text-xs text-gray-500">
                                <i class="fas fa-clock mr-1"></i>
                                <span>25 min</span>
                            </div>
                            <div class="flex items-center text-xs text-gray-500">
                                <i class="fas fa-utensil-spoon mr-1"></i>
                                <span>Fácil</span>
                            </div>
                            <div class="flex items-center text-xs text-green-600">
                                <i class="fas fa-seedling mr-1"></i>
                                <span>Zero waste</span>
                            </div>
                        </div>
                        <button class="view-ingredients-btn w-full py-2 bg-green-50 text-green-600 rounded-lg text-sm font-medium mb-3">
                            Ver Ingredientes <i class="fas fa-chevron-down ml-1"></i>
                        </button>
                        <div class="ingredients-list">
                            <div class="text-sm text-gray-600 mb-2 font-medium">Ingredientes:</div>
                            <div class="ingredient-item">2 xícaras de arroz cozido (sobras)</div>
                            <div class="ingredient-item">1 ovo</div>
                            <div class="ingredient-item">2 colheres de sopa de farinha de trigo</div>
                            <div class="ingredient-item">1/2 xícara de queijo ralado</div>
                            <div class="ingredient-item">1 colher de sopa de cebolinha picada</div>
                            <div class="ingredient-item">Sal e pimenta a gosto</div>
                            <div class="ingredient-item">Óleo para fritar</div>
                        </div>
                    </div>
                </div>
                <div class="recipe-card bg-white rounded-xl overflow-hidden shadow-sm transition-all duration-300">
                    <div class="h-40 bg-green-100 flex items-center justify-center">
                        <i class="fas fa-hamburger text-4xl text-green-600"></i>
                    </div>
                    <div class="p-4">
                        <h3 class="font-medium text-gray-800 mb-2">Hambúrguer de Grão-de-Bico</h3>
                        <p class="text-gray-600 text-sm mb-3">Opção proteica vegana com 60% menos carbono que carne bovina</p>
                        <div class="flex justify-between items-center mb-3">
                            <div class="flex items-center text-xs text-gray-500">
                                <i class="fas fa-clock mr-1"></i>
                                <span>40 min</span>
                            </div>
                            <div class="flex items-center text-xs text-gray-500">
                                <i class="fas fa-utensil-spoon mr-1"></i>
                                <span>Médio</span>
                            </div>
                            <div class="flex items-center text-xs text-green-600">
                                <i class="fas fa-water mr-1"></i>
                                <span>90% menos água</span>
                            </div>
                        </div>
                        <button class="view-ingredients-btn w-full py-2 bg-green-50 text-green-600 rounded-lg text-sm font-medium mb-3">
                            Ver Ingredientes <i class="fas fa-chevron-down ml-1"></i>
                        </button>
                        <div class="ingredients-list">
                            <div class="text-sm text-gray-600 mb-2 font-medium">Ingredientes:</div>
                            <div class="ingredient-item">2 xícaras de grão-de-bico cozido</div>
                            <div class="ingredient-item">1/2 xícara de aveia em flocos</div>
                            <div class="ingredient-item">1 cebola pequena picada</div>
                            <div class="ingredient-item">2 dentes de alho amassados</div>
                            <div class="ingredient-item">1 colher de sopa de salsinha picada</div>
                            <div class="ingredient-item">1 colher de chá de cominho</div>
                            <div class="ingredient-item">Sal e pimenta a gosto</div>
                            <div class="ingredient-item">Azeite para grelhar</div>
                        </div>
                    </div>
                </div>
                <div class="recipe-card bg-white rounded-xl overflow-hidden shadow-sm transition-all duration-300">
                    <div class="h-40 bg-green-100 flex items-center justify-center">
                        <i class="fas fa-pepper-hot text-4xl text-green-600"></i>
                    </div>
                    <div class="p-4">
                        <h3 class="font-medium text-gray-800 mb-2">Curry de Legumes da Estação</h3>
                        <p class="text-gray-600 text-sm mb-3">Aproveite vegetais com preços até 40% mais baixos nesta época</p>
                        <div class="flex justify-between items-center mb-3">
                            <div class="flex items-center text-xs text-gray-500">
                                <i class="fas fa-clock mr-1"></i>
                                <span>35 min</span>
                            </div>
                            <div class="flex items-center text-xs text-gray-500">
                                <i class="fas fa-utensil-spoon mr-1"></i>
                                <span>Fácil</span>
                            </div>
                            <div class="flex items-center text-xs text-green-600">
                                <i class="fas fa-truck mr-1"></i>
                                <span>Km 0</span>
                            </div>
                        </div>
                        <button class="view-ingredients-btn w-full py-2 bg-green-50 text-green-600 rounded-lg text-sm font-medium mb-3">
                            Ver Ingredientes <i class="fas fa-chevron-down ml-1"></i>
                        </button>
                        <div class="ingredients-list">
                            <div class="text-sm text-gray-600 mb-2 font-medium">Ingredientes:</div>
                            <div class="ingredient-item">2 batatas médias cortadas em cubos</div>
                            <div class="ingredient-item">1 abobrinha em rodelas</div>
                            <div class="ingredient-item">1 cenoura em rodelas</div>
                            <div class="ingredient-item">1 cebola picada</div>
                            <div class="ingredient-item">2 dentes de alho picados</div>
                            <div class="ingredient-item">1 colher de sopa de curry em pó</div>
                            <div class="ingredient-item">400ml de leite de coco</div>
                            <div class="ingredient-item">Sal a gosto</div>
                            <div class="ingredient-item">Azeite para refogar</div>
                        </div>
                    </div>
                </div>
                <div class="recipe-card bg-white rounded-xl overflow-hidden shadow-sm transition-all duration-300">
                    <div class="h-40 bg-green-100 flex items-center justify-center">
                        <i class="fas fa-pancakes text-4xl text-green-600"></i>
                    </div>
                    <div class="p-4">
                        <h3 class="font-medium text-gray-800 mb-2">Panqueca de Aveia e Banana</h3>
                        <p class="text-gray-600 text-sm mb-3">Café da manhã nutritivo com ingredientes básicos</p>
                        <div class="flex justify-between items-center mb-3">
                            <div class="flex items-center text-xs text-gray-500">
                                <i class="fas fa-clock mr-1"></i>
                                <span>15 min</span>
                            </div>
                            <div class="flex items-center text-xs text-gray-500">
                                <i class="fas fa-utensil-spoon mr-1"></i>
                                <span>Fácil</span>
                            </div>
                            <div class="flex items-center text-xs text-green-600">
                                <i class="fas fa-coins mr-1"></i>
                                <span>Custo: R$ 1,50/porção</span>
                            </div>
                        </div>
                        <button class="view-ingredients-btn w-full py-2 bg-green-50 text-green-600 rounded-lg text-sm font-medium mb-3">
                            Ver Ingredientes <i class="fas fa-chevron-down ml-1"></i>
                        </button>
                        <div class="ingredients-list">
                            <div class="text-sm text-gray-600 mb-2 font-medium">Ingredientes:</div>
                            <div class="ingredient-item">1 banana madura amassada</div>
                            <div class="ingredient-item">1 ovo</div>
                            <div class="ingredient-item">1/2 xícara de aveia em flocos</div>
                            <div class="ingredient-item">1 colher de chá de canela em pó</div>
                            <div class="ingredient-item">1 pitada de sal</div>
                            <div class="ingredient-item">1 colher de chá de fermento em pó</div>
                            <div class="ingredient-item">Manteiga ou óleo para untar</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="mb-12">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6 section-title">♻️ Dicas de Consumo Consciente</h2>
            <p class="text-gray-600 mb-6">
                Adote práticas sustentáveis no dia a dia com dicas rápidas e fáceis.
            </p>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="tip-card bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex items-start mb-3">
                        <div class="bg-green-100 p-2 rounded-lg mr-3">
                            <i class="fas fa-recycle text-green-600"></i>
                        </div>
                        <h3 class="font-medium text-gray-800">Embalagens sustentáveis</h3>
                    </div>
                    <p class="text-gray-600 text-sm mb-3">Prefira produtos com embalagens recicláveis ou retornáveis. Vidro, alumínio e papelão são mais facilmente reciclados que plásticos mistos.</p>
                    <div class="flex items-center text-xs text-green-600">
                        <i class="fas fa-lightbulb mr-1"></i>
                        <span>Dica: Leve seus próprios recipientes para feiras e mercados</span>
                    </div>
                </div>
                <div class="tip-card bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex items-start mb-3">
                        <div class="bg-green-100 p-2 rounded-lg mr-3">
                            <i class="fas fa-shopping-bag text-green-600"></i>
                        </div>
                        <h3 class="font-medium text-gray-800">Alternativas reutilizáveis</h3>
                    </div>
                    <p class="text-gray-600 text-sm mb-3">Uma sacola de algodão pode substituir mais de 700 sacolas plásticas durante sua vida útil. Invista em ecobags, potes de vidro e garrafas duráveis.</p>
                    <div class="flex items-center text-xs text-green-600">
                        <i class="fas fa-calculator mr-1"></i>
                        <span>Economia potencial: R$ 200/ano em descartáveis</span>
                    </div>
                </div>
                <div class="tip-card bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex items-start mb-3">
                        <div class="bg-green-100 p-2 rounded-lg mr-3">
                            <i class="fas fa-list text-green-600"></i>
                        </div>
                        <h3 class="font-medium text-gray-800">Listas inteligentes</h3>
                    </div>
                    <p class="text-gray-600 text-sm mb-3">Planejar compras reduz em 30% o desperdício de alimentos. Agrupe itens por categoria (hortifruti, laticínios, etc.) para otimizar seu tempo no mercado.</p>
                    <div class="flex items-center text-xs text-green-600">
                        <i class="fas fa-chart-line mr-1"></i>
                        <span>Famílias que planejam economizam até R$ 3.000/ano</span>
                    </div>
                </div>
                <div class="tip-card bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex items-start mb-3">
                        <div class="bg-green-100 p-2 rounded-lg mr-3">
                            <i class="fas fa-store text-green-600"></i>
                        </div>
                        <h3 class="font-medium text-gray-800">Produtores locais</h3>
                    </div>
                    <p class="text-gray-600 text-sm mb-3">Alimentos locais percorrem em média 70km até o consumidor, contra 2.500km de produtos importados. Isso significa 96% menos emissões de CO2.</p>
                </div>
                <div class="tip-card bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex items-start mb-3">
                        <div class="bg-green-100 p-2 rounded-lg mr-3">
                            <i class="fas fa-tag text-green-600"></i>
                        </div>
                        <h3 class="font-medium text-gray-800">Entenda os rótulos</h3>
                    </div>
                    <p class="text-gray-600 text-sm mb-3">Listas de ingredientes são ordenadas por quantidade. Evite produtos com: gordura vegetal hidrogenada, xarope de milho, corantes artificiais e glutamato monossódico.</p>
                    <div class="flex items-center text-xs text-green-600">
                        <i class="fas fa-certificate mr-1"></i>
                        <span>Procure selos: orgânico, fair trade, cruelty free</span>
                    </div>
                </div>
            </div>
        </section>
        <section class="mb-12">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6 section-title">💰 Economize com Consciência</h2>
            <p class="text-gray-600 mb-6">
                Dicas práticas para economizar ao comprar alimentos e produtos, sem comprometer a qualidade.
            </p>
            <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex items-start">
                        <div class="bg-green-100 p-2 rounded-lg mr-4">
                            <i class="fas fa-balance-scale text-green-600"></i>
                        </div>
                        <div>
                            <h3 class="font-medium text-gray-800 mb-2">Compare preços por unidade</h3>
                            <p class="text-gray-600 text-sm">Verifique o preço por quilo ou litro para fazer melhores comparações entre produtos de diferentes tamanhos. Embalagens familiares podem ser até 40% mais econômicas.</p>
                            <div class="mt-2 flex items-center text-xs text-green-600">
                                <i class="fas fa-chart-pie mr-1"></i>
                                <span>Famílias economizam R$ 1.800/ano com esta prática</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="bg-green-100 p-2 rounded-lg mr-4">
                            <i class="fas fa-calendar-alt text-green-600"></i>
                        </div>
                        <div>
                            <h3 class="font-medium text-gray-800 mb-2">Prefira alimentos da estação</h3>
                            <p class="text-gray-600 text-sm">Frutas e vegetais da época são 30-50% mais baratos, mais saborosos e têm menor impacto ambiental. Consulte nosso calendário de safra mensal.</p>
                            <div class="mt-2 flex items-center text-xs text-green-600">
                                <i class="fas fa-percentage mr-1"></i>
                                <span>Abacaxi: R$ 3,50 (safra) vs R$ 8,90 (fora)</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="bg-green-100 p-2 rounded-lg mr-4">
                            <i class="fas fa-weight text-green-600"></i>
                        </div>
                        <div>
                            <h3 class="font-medium text-gray-800 mb-2">Compre a granel</h3>
                            <p class="text-gray-600 text-sm">Adquira apenas a quantidade necessária de produtos secos para reduzir desperdício e economizar. Grãos, castanhas e temperos podem ser 25% mais baratos a granel.</p>
                            <div class="mt-2 flex items-center text-xs text-green-600">
                                <i class="fas fa-seedling mr-1"></i>
                                <span>Redução de 80% nas embalagens descartadas</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="bg-green-100 p-2 rounded-lg mr-4">
                            <i class="fas fa-clipboard-list text-green-600"></i>
                        </div>
                        <div>
                            <h3 class="font-medium text-gray-800 mb-2">Lista de compras</h3>
                            <p class="text-gray-600 text-sm">Faça uma lista antes de sair e vá alimentado para evitar compras por impulso. Comprar com fome aumenta em 23% as compras não planejadas.</p>
                            <div class="mt-2 flex items-center text-xs text-green-600">
                                <i class="fas fa-wallet mr-1"></i>
                                <span>Economia média por lista: R$ 45 por compra</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="flex items-center mb-4 md:mb-0">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center mr-3">
                        <img src="/dev-site/assets/img/logo.png" alt="logo">
                    </div>
                    <span class="text-xl font-semibold">Consumo Consciente</span>
                </div>
                <div class="text-gray-400 text-sm">
                    © 2025 Consumo Consciente. Todos os direitos reservados.
                </div>
            </div>
        </div>
    </footer>
    <a href="../chatbot_/templates/chatbot.html" class="floating-btn bg-green-600 text-white px-6 py-3 rounded-full flex items-center" style="position: fixed; bottom: 32px; right: 32px; z-index: 50;">
        <i class="fas fa-comment-dots mr-2"></i>
        Abrir Chatbot
    </a>
    <script>
    // filepath: c:\xaamp\htdocs\dev-site\pos_login\pos.php
    const menuBtn = document.getElementById('menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const closeMenu = document.getElementById('close-menu');

    menuBtn.addEventListener('click', () => {
        mobileMenu.classList.remove('hidden');
    });

    closeMenu.addEventListener('click', () => {
        mobileMenu.classList.add('hidden');
    });

    // Fecha o menu ao clicar fora dele
    mobileMenu.addEventListener('click', (e) => {
        if (e.target === mobileMenu) {
            mobileMenu.classList.add('hidden');
        }
    });
    </script>
    <script src="pos.js"></script>
</body>
</html>