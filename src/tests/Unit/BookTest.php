<?php

use Tests\TestCase;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_book_can_be_created()
    {
        $book = Book::create([
            'title' => 'The Great Gatsby',
            'author' => 'F. Scott Fitzgerald',
        ]);

        $this->assertDatabaseHas('books', [
            'title' => 'The Great Gatsby',
            'author' => 'F. Scott Fitzgerald',
        ]);
    }

    // /** @test */
    // public function it_can_get_all_books()
    // {
    //     // Create 3 books using the factory
    //     factory(Book::class, 3)->create();

    //     // Call the getAllBooks method or endpoint to retrieve books
    //     $response = $this->get('/api/books'); // Adjust route as per your application

    //     // Assert that the response contains 3 books
    //     $response->assertStatus(200)
    //              ->assertJsonCount(3);
    // }

    // /** @test */
    // public function it_can_delete_specific_book()
    // {
    //     // Create a book using the factory
    //     $book = factory(Book::class)->create();

    //     // Delete the book using the API or method
    //     $response = $this->delete('/api/books/' . $book->id); // Adjust route as per your application

    //     // Assert that the book was successfully deleted
    //     $response->assertStatus(204);

    //     // Verify that the book no longer exists in the database
    //     $this->assertDatabaseMissing('books', ['id' => $book->id]);
    // }
}
