using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace StockManagement
{
    public class ReOrderPointStockStrategy : Strategy
    {

        int reorder_point;
        int reorder_quantity;

        public ReOrderPointStockStrategy(Product product, int reorder_point, int reorder_quantity) : base(2, product)
        {
            this.Reorder_point = reorder_point;
            this.Reorder_quantity = reorder_quantity;
        }

        public int Reorder_point { get => reorder_point; set => reorder_point = value; }
        public int Reorder_quantity { get => reorder_quantity; set => reorder_quantity = value; }

        public bool check_order_point()
        {
            return Product.quantity == reorder_point;
        }
        public override void reorder()
        {
            if (check_order_point())
            {
                Product.quantity += reorder_quantity;
            }
        }


    }
}
