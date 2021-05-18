using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace StockManagement
{
    public class Strategy
    {
        int id_strategy;

        Product product;

        public Strategy(int id_strategy, Product product)
        {
            this.id_strategy = id_strategy;
            this.product = product;
        }

        public int Id_strategy { get => id_strategy; set => id_strategy = value; }
        internal Product Product { get => product; set => product = value; }

        public virtual void reorder()
        {

        }
        public virtual void reorder(DateTime date_actu)
        {

        }
    }
}
