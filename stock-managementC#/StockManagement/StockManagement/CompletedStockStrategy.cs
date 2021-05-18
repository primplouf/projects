using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace StockManagement
{
    class CompletedStockStrategy : Strategy
    {

        int reorder_cycle;
        int complete_stock;

        public CompletedStockStrategy(Product product, int reorder_cycle, int complete_stock) : base(3, product)
        {
            this.Reorder_cycle = reorder_cycle;
            this.Complete_stock = complete_stock;
        }

        public int Reorder_cycle { get => reorder_cycle; set => reorder_cycle = value; }
        public int Complete_stock { get => complete_stock; set => complete_stock = value; }

        public override void reorder(DateTime date_actu)
        {
                DateTime lastOrder = Product.lastOrderDate;
                DateTime nextOrderDate = Product.lastOrderDate.AddDays(reorder_cycle);
                Product.lastOrderDate = lastOrder;

                if (Product.quantity < complete_stock && date_actu == nextOrderDate)
                {
                    Product.quantity += complete_stock - Product.quantity;
                }
        }

    }
}
