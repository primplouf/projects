#include <iostream>
#include <cstdlib>
#include "compte.h"
#include "banque.h"

using namespace std;

int main(){
    banque b(10);
    cout << "Bienvenue dans le menu : " << endl;
    while(true){
        cout << "______________________________" << endl;
        cout << "Veuillez choisir une action : " << endl;
        cout << "1 - Creer un compte" << endl;
        cout << "2 - Crediter ou debiter un compte" << endl;
        cout << "3 - Supprimer un compte" << endl;
        cout << "4 - Afficher un compte" << endl;
        cout << "5 - Afficher tous les comptes" << endl;
        cout << "6 - Quitter le menu" << endl;
        int numAction;
        cin >> numAction;
        switch(numAction){
            case 1:
            {
                cout << "______________________________" << endl;
                cout << "Entrer le nom du compte : " << endl;
                string nom;
                cin >> nom;
                cout << "Entrer le solde du compte : " << endl;
                float solde;
                cin >> solde;
                cout << "Entrer le decouvert maximum du compte : " << endl;
                float decouvert;
                cin >> decouvert;
                b.ajouteCompte(nom, solde, decouvert);
                break;
            }   
            case 2:
            {
                cout << "______________________________" << endl;
                cout << "Veuillez choisir un compte par son numero : " << endl;
                b.afficheAllComptes();
                int num;
                cin >> num;
                cout << "Veuillez choisir une action : " << endl;
                cout << "1 - Crediter le compte" << endl;
                cout << "2 - Debiter le compte" << endl;
                int action;
                cin >> action;
                switch(action){
                    case 1:
                    {
                        cout << "______________________________" << endl;
                        cout << "De combien souhaitez vous crediter le compte?"  << endl;
                        int somme;
                        cin >> somme;
                        compte c = b.getCompte(num);
                        c.crediter(somme);
                        break;
                    }    
                    case 2:
                    {
                        cout << "______________________________" << endl;
                        cout << "De combien souhaitez vous debiter le compte?"  << endl;
                        int somme;
                        cin >> somme;
                        compte c = b.getCompte(num);
                        c.debiter(somme);
                        break;
                    }
                }
                break;
            }
            case 3:
            {   
                cout << "______________________________" << endl;
                cout << "Veuillez choisir un compte par son numero : " << endl;
                b.afficheAllComptes();
                int num;
                cin >> num;
                b.supprimeCompte(num);
                break;
            }
            case 4:
            {
                cout << "______________________________" << endl;
                if(b.getNbc()!=0){
                    b.afficheAllComptes();
                    cout << "Veuillez choisir un compte par son numero : " << endl;
                    int num;
                    cin >> num;
                    bool validNum = b.checkNumeroComptes(num);
                    if (validNum){
                        compte c = b.getCompte(num);
                        c.afficher();
                    } else {
                        cout << "Ce numero de compte est invalide" << endl;
                    }  
                } else {
                    cout << "Aucun compte n'a ete ajoute" << endl;                   
                }
                break;
            }
            case 5:
            {
                cout << "______________________________" << endl;
                if(b.getNbc()!=0){
                    b.afficheAllComptes();
                } else {
                    cout << "Aucun compte n'a ete ajoute" << endl;                   
                }
                break;
            }
            case 6:
            {
                exit(0);
            }
        }
    }
}