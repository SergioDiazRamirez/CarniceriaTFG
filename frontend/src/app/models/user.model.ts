export interface User {
    id: number;
    name: string;
    email: string;
    billing_address_id: number | null;
    default_address_id: number | null;
    addresses: any[]; // TODO: definir tipo Address
}