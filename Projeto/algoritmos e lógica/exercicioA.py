def main():
    # Inicializa uma lista vazia para armazenar os elementos.
    elementos = []

    while True:
        print("Escolha uma opção:")
        print("1 - Registrar elemento")
        print("2 - Listar elementos")
        print("3 - Excluir elemento")
        print("4 - Ver quantidade de elementos registrados")
        print("5 - Listar elementos na ordem inversa")
        print("0 - Sair")

        opcao = input("Opção: ")

        if opcao == "1":
            # Solicita ao usuário um número inteiro não negativo e registra na lista de elementos.
            elemento = int(input("Digite um número inteiro não negativo: "))
            if elemento >= 0:
                elementos = registrar_elemento(elementos, elemento)
            else:
                print("Elementos negativos não são permitidos.")
        elif opcao == "2":
            # Lista os elementos atualmente registrados.
            print("Elementos registrados:", elementos)
        elif opcao == "3":
            # Solicita ao usuário um número para excluir da lista de elementos.
            elemento = int(input("Digite o número a ser excluído: "))
            resultado = excluir_elemento(elementos, elemento)
            if resultado is not None:
                elementos = resultado
            else:
                print("Elemento não encontrado.")
        elif opcao == "4":
            # Calcula e exibe a quantidade de elementos registrados.
            quantidade = contar_elementos(elementos)
            print("Quantidade de elementos registrados:", quantidade)
        elif opcao == "5":
            # Lista os elementos na ordem inversa à ordem de inserção.
            print("Elementos na ordem inversa:")
            elementos_inversos = listar_elementos_inversos(elementos)
            for elemento in elementos_inversos:
                print(elemento)
        elif opcao == "0":
            # Encerra o programa.
            break
        else:
            # Exibe uma mensagem de opção inválida se o usuário escolher uma opção não reconhecida.
            print("Opção inválida. Tente novamente.")


def registrar_elemento(elementos, elemento):
    # Registra um novo elemento na lista de elementos.
    novos_elementos = elementos.copy()
    novos_elementos.append(elemento)
    return novos_elementos


def excluir_elemento(elementos, elemento):
    # Exclui um elemento específico da lista de elementos, se ele existir.
    if elemento in elementos:
        novos_elementos = []
        for item in elementos:
            if item != elemento:
                novos_elementos.append(item)
        return novos_elementos
    return None


def contar_elementos(elementos):
    # Conta e retorna a quantidade de elementos na lista.
    quantidade = 0
    for _ in elementos:
        quantidade += 1
    return quantidade


def listar_elementos_inversos(elementos):
    # Retorna uma lista de elementos na ordem inversa à ordem de inserção.
    elementos_inversos = []
    for i in range(len(elementos) - 1, -1, -1):
        elementos_inversos.append(elementos[i])
    return elementos_inversos


if __name__ == "__main__":
    main()
