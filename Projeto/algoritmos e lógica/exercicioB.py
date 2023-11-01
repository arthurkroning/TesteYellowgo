def main():
    elementos = []

    while True:
        print("Escolha uma opção:")
        print("1 - Inserir elemento")
        print("2 - Ordenar elementos")
        print("0 - Sair")

        opcao = input("Opção: ")

        if opcao == "1":
            numero = input("Digite um número inteiro: ")
            try:
                numero = int(numero)
                elementos.append(numero)
            except ValueError:
                print(
                    "Erro ao inserir elemento. Certifique-se de fornecer um número inteiro válido."
                )
        elif opcao == "2":
            if not elementos:
                print("A lista de elementos está vazia.")
            else:
                ordem = input(
                    "Escolha a ordem (0 para crescente, 1 para decrescente): "
                )
                if ordem == "0":
                    elementos = ordenar_elementos(elementos, crescente=True)
                    print("Elementos ordenados em ordem crescente:", elementos)
                elif ordem == "1":
                    elementos = ordenar_elementos(elementos, crescente=False)
                    print("Elementos ordenados em ordem decrescente:", elementos)
                else:
                    print(
                        "Opção de ordem inválida. Use '0' para crescente ou '1' para decrescente."
                    )
        elif opcao == "0":
            break
        else:
            print("Opção inválida. Tente novamente.")


def ordenar_elementos(elementos, crescente=True):
    novos_elementos = sorted(elementos)
    if not crescente:
        novos_elementos.reverse()
    return novos_elementos


if __name__ == "__main__":
    main()
