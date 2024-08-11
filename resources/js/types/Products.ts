interface Product {
    title: string;
    caption: string;
    image: string;
    image_thumbnail: string;
    price: string;
    status: 0 | 1;
}

export type { Product as ProductType };

interface Products {
    products: Product[];
}
export type { Products as ProductsType };
