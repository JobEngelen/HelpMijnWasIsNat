<?
class OrderContent
{
    private int $order_id;
    private string $title;
    private float $price;
    private string $image;
    private int $quantity;

    public function getOrderId(): int
    {
        return $this->order_id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }
}
