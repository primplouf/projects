using System;
using System.Collections.Generic;
using System.Text;

namespace StockManagement
{
    class Order
    {
        public int count = 0;

        public int id_order;

        public int Id_order
        {
            get { return id_order; }
            set { id_order = value; }
        }

        public int id_product;

        public int Id_product
        {
            get { return id_product; }
            set { id_product = value; }
        }

        public int quantity;

        public int Quantity
        {
            get { return quantity; }
            set { quantity = value; }
        }

        public DateTime date;
        public DateTime Date
        {
            get { return date; }
            set { date = value; }
        }

        public Order(int id_product, int quantity, DateTime date)
        {
            this.id_order = count;
            count += 1;
            this.id_product = id_product;
            this.quantity = quantity;
            this.date = date;
        }
    }
}
