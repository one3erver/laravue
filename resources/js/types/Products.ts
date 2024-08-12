interface Product {
    id: number;
    title: string;
    caption: string;
    image: string;
    image_thumbnail: string;
    price: string;
    stock: number;
    status: 0 | 1;
}

export type { Product as ProductType };

interface Products {
    products: Product[];
}
export type { Products as ProductsType };
