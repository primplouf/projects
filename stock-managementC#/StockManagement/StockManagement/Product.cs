using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace StockManagement
{
    public class Product
    {
        public static int count = 0;

        public int id_product;
        public string name_product;
        public int price_product;
        public int quantity;
        public DateTime lastOrderDate;


        public Product(string name_product, int price_product, int quantity)
        {
            this.id_product = count;
            count += 1;
            this.name_product = name_product;
            this.price_product = price_product;
            this.quantity = quantity;
        }

        public int Id_product
        {
            get { return id_product; }
            set { id_product = value; }
        }
        public string Name_product
        {
            get { return name_product; }
            set { name_product = value; }
        }
        public int Price_product
        {
            get { return price_product; }
            set { price_product = value; }
        }
        public int Quantity
        {
            get { return quantity; }
            set { quantity = value; }
        }

        public DateTime LastOrderDate { get => lastOrderDate; set => lastOrderDate = value; }
    }
}
