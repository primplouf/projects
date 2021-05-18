using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace StockManagement
{
    class PeriodicStockStrategy : Strategy
    {

        int reorder_cycle;
        int reorder_amount;

        public PeriodicStockStrategy(Product product, int reorder_cycle, int reorder_amount) : base(1, product)
        {
            this.Reorder_cycle = reorder_cycle;
            this.Reorder_amount = reorder_amount;
        }

        public int Reorder_cycle { get => reorder_cycle; set => reorder_cycle = value; }
        public int Reorder_amount { get => reorder_amount; set => reorder_amount = value; }

        public override void reorder(DateTime date_actu)
        {
                DateTime lastOrder = Product.lastOrderDate;
                DateTime nextOrderDate = Product.lastOrderDate.AddDays(reorder_cycle);
                Product.lastOrderDate = lastOrder;

                if (date_actu == nextOrderDate)
                {
                    Product.quantity += reorder_amount;
                }
        }
    }
}
