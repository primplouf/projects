#include <iostream>
#include <cstdlib>
#pragma once

using namespace std;

class compte
{
    private :
    int numeroCompte;
    string nomCompte;
    float soldeCompte;
    float decouvertMax;
    static int numeroAttribue;

    public :
    compte(string, float, float);
    compte(const compte&);
    compte();
    ~compte();

    int getNumero() const;
    string getNom() const;
    float getSolde() const;
    float getDecouvertmax() const;
    void debiter(float);
    void crediter(float);
    void afficher() const;
    static int getDernierNumeroAttribue();
};
