using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace StockManagement
{
    class Program
    {
        static void Main(string[] args)
        {
            List<Product> pl = new List<Product>();
            List<Order> ol = new List<Order>();
            WarehouseStock wh = new WarehouseStock(ol, pl);
            while (true)
            {
                Console.WriteLine("Chose an action :");
                Console.WriteLine("1 - Add Product");
                Console.WriteLine("2 - Print capital cost");
                Console.WriteLine("3 - Print total number of products stocked");
                Console.WriteLine("4 - Print next ordered list");
                Console.WriteLine("5 - Print the list of orders for a month");
                Console.WriteLine("6 - Print the list of orders for a year");
                Console.WriteLine("7 - Print the total ordered for a month");
                Console.WriteLine("8 - Print the total ordered for a year");
                Console.WriteLine("9 - Exit");
                int action = Int32.Parse(Console.ReadLine());
                if (action == 1)
                {
                    Console.WriteLine("Name : ");
                    string name = Console.ReadLine();
                    Console.WriteLine("Price : ");
                    int price = Int32.Parse(Console.ReadLine());
                    Console.WriteLine("Quantity : ");
                    int qtty = Int32.Parse(Console.ReadLine());
                    Product p = new Product(name, price, qtty);
                    Console.WriteLine("Select a strategy for the product " + name + " : ");
                    Console.WriteLine("1 - PeriodicStockStrategy");
                    Console.WriteLine("2 - CompletedStockStrategy");
                    Console.WriteLine("3 - ReorderPointStrategy");
                    int strategy = Int32.Parse(Console.ReadLine());
                    if (strategy == 1)
                    {
                        Console.WriteLine("Enter reorder cycle : ");
                        int reocycle = Int32.Parse(Console.ReadLine());
                        Console.WriteLine("Enter reorder amount : ");
                        int reoamount = Int32.Parse(Console.ReadLine());
                        new PeriodicStockStrategy(p, reocycle, reoamount);
                    }
                    else if (strategy == 2)
                    {
                        Console.WriteLine("Enter reorder cycle : ");
                        int reocycle = Int32.Parse(Console.ReadLine());
                        Console.WriteLine("Enter total amount of complete stock : ");
                        int completestock = Int32.Parse(Console.ReadLine());
                        new CompletedStockStrategy(p, reocycle, completestock);
                    }
                    else if (strategy == 3)
                    {
                        Console.WriteLine("Enter reorder point : ");
                        int reopoint = Int32.Parse(Console.ReadLine());
                        Console.WriteLine("Enter reorder quantity : ");
                        int reoqtty = Int32.Parse(Console.ReadLine());
                        new CompletedStockStrategy(p, reopoint, reoqtty);
                    }
                    else
                    {
                        Console.WriteLine("Tu les fais exprès gros");
                    }
                    wh.ListProduct.Add(p);
                    Console.WriteLine("Product " + name + " has been registered");
                }
                else if (action == 2)
                {
                    Console.WriteLine("Capital cost : " + wh.capital_cost());
                }
                else if (action == 3)
                {
                    Console.WriteLine("Total products stocked : " + wh.totalNumberProducts());
                }
                else if (action == 4)
                {
                    if (wh.listProduct == null)
                    {
                        Console.WriteLine("No products created yet");
                    }
                    else if (wh.listOrder == null)
                    {
                        Console.WriteLine("No orders yet");
                    }
                    else
                    {
                        Console.WriteLine("Next orders : ");

                        List<Order> listOrdered = wh.listNextOrdered();
                        foreach (Order o in listOrdered)
                        {
                            string namep = null;
                            foreach (Product p in pl)
                            {
                                if (p.id_product == o.id_product)
                                {
                                    namep = p.name_product;
                                    break;
                                }
                            }
                            Console.WriteLine(" - " + o.date + " " + o.quantity + " of " + namep);
                        }
                    }

                }
                else if (action == 5)
                {
                    if (wh.listOrder != null)
                    {
                        Console.WriteLine("Next orders for a month : ");

                        List<Order> listOrdered = wh.listOrderMonth();
                        foreach (Order o in listOrdered)
                        {
                            string namep = null;
                            foreach (Product p in pl)
                            {
                                if (p.id_product == o.id_product)
                                {
                                    namep = p.name_product;
                                    break;
                                }
                            }
                            Console.WriteLine(" - " + o.date + " " + o.quantity + " of " + namep);
                        }
                    }
                    else
                    {
                        Console.WriteLine("No orders yet");
                    }
                }
                else if (action == 6)
                {
                    if (wh.listOrder != null)
                    {
                        Console.WriteLine("Next orders for a year : ");

                        List<Order> listOrdered = wh.listOrderYear();
                        foreach (Order o in listOrdered)
                        {
                            string namep = null;
                            foreach (Product p in pl)
                            {
                                if (p.id_product == o.id_product)
                                {
                                    namep = p.name_product;
                                    break;
                                }
                            }
                            Console.WriteLine(" - " + o.date + " " + o.quantity + " of " + namep);
                        }
                    }
                    else
                    {
                        Console.WriteLine("No orders yet");
                    }
                }
                else if (action == 7)
                {
                    Console.WriteLine("Total ordered for a month : " + wh.totalOrderedMonth());
                }
                else if (action == 8)
                {
                    Console.WriteLine("Total ordered for a year : " + wh.totalOrderedYear());
                }
                else if (action == 9)
                {
                    Environment.Exit(0);
                }
                else
                {
                    Console.WriteLine("Invalid action, please retry");
                }
            }
        }
    }
}
