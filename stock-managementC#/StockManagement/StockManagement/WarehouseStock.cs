using System;
using System.Collections.Generic;
using System.Text;

namespace StockManagement
{
    class WarehouseStock
    {

        public List<Order> listOrder;

        public List<Order> ListOrder
        {
            get { return listOrder; }
            set { listOrder = value; }
        }

        public List<Product> listProduct;

        public List<Product> ListProduct
        {
            get { return listProduct; }
            set { listProduct = value; }
        }

        public WarehouseStock(List<Order> listOrder, List<Product> listProduct)
        {
            this.listOrder = listOrder;
            this.listProduct = listProduct;
        }

       public int capital_cost()
        {
            int totalcost = 0;
            foreach(Product product in listProduct)
            {
                totalcost += product.quantity * product.price_product;
            }
            return totalcost;
        }

       public int totalNumberProducts()
        {
            int numberproducts = 0;
            foreach(Product product in listProduct)
            {
                numberproducts += product.quantity;
            }
            return numberproducts;
        }

        public Order listNextOrder()
        {
            Order nextorder = null;
            DateTime todate = DateTime.Now;
            DateTime nextdate = new DateTime();
            foreach(Order order in listOrder)
            {
                if (order.date >= todate)
                {
                    if (nextdate == null)
                    {
                        nextdate = order.date;
                        nextorder = order;
                    } else
                    {
                        if (nextdate < order.date){
                            nextdate = order.date;
                            nextorder = order;
                        } 
                    }
                }
            }
            return nextorder;
        }

        public List<Order> listNextOrdered()
        {
            List<Order> lorder = new List<Order>();
            DateTime todate = DateTime.Now;
            foreach (Order order in listOrder)
            {
                if (order.date >= todate)
                {
                    lorder.Add(order);
                }
            }
            return lorder;
        }

        public List<Order> listOrderMonth()
        {
            List<Order> monthlist = new List<Order>();
            DateTime todate = DateTime.Now;
            DateTime nextmonthdate = DateTime.Now;
            nextmonthdate.AddMonths(1);
            foreach (Order order in listOrder)
            {
                if (order.date <= nextmonthdate && order.date >= todate)
                {
                    monthlist.Add(order);
                }
            }
            return monthlist;
        }

        public List<Order> listOrderYear()
        {
            List<Order> yearlist = new List<Order>();
            DateTime todate = DateTime.Now;
            DateTime nextyeardate = DateTime.Now;
            nextyeardate.AddYears(1);
            foreach (Order order in listOrder)
            {
                if (order.date <= nextyeardate && order.date >= todate)
                {
                    yearlist.Add(order);
                }
            }
            return yearlist;
        }

        public int totalOrderedMonth()
        {
            int totalcostmonth = 0;
            List <Order> listmonth = listOrderMonth();
            foreach(Order order in listmonth)
            {
                foreach(Product product in listProduct)
                {
                    if(product.id_product == order.id_product)
                    {
                        totalcostmonth += order.quantity * product.price_product;
                    }
                }  
            }
            return totalcostmonth;
        }

        public int totalOrderedYear()
        {
            int totalcostyear = 0;
            List<Order> listyear = listOrderYear();
            foreach (Order order in listyear)
            {
                foreach (Product product in listProduct)
                {
                    if (product.id_product == order.id_product)
                    {
                        totalcostyear += order.quantity * product.price_product;
                    }
                }
            }
            return totalcostyear;
        }
    }
}
